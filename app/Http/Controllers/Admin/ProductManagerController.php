<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $products = Product::paginate(20);
        return ViewController::view('admin.product.index', 'Sản phẩm', 'Quản lý sản phẩm')
            ->with('products', $products);
    }

    public function create()
    {
        $categories = Category::all();
        return ViewController::view('admin.product.create', 'Sản phẩm', 'Quản lý sản phẩm')
            ->with(['categories' => $categories]);
    }

    private function moveFileToDir($image, $pathname, $thumb = false)
    {
        $filename = $pathname . '.' . $image->getClientOriginalExtension();
        $dir = $thumb ? UPLOAD_DIR_THUMB : UPLOAD_DIR;
        if ($image->move($dir, $filename)) {
            return $dir . '/' . $filename;
        }
        return null;
    }

    private function addImage($image, $productID = null, $pathname)
    {
        $pathname = $pathname . '-' . str_slug(microtime());
        if (($urlImage = $this->moveFileToDir($image, $pathname)) != null) {
            Image::create([
                'productid' => $productID,
                'url' => $urlImage,
            ]);
        }
        return $urlImage;
    }

    private function validatorCateogryExist($request)
    {
        $validator = Validator::make($request->all(), [
            'danh_muc' => 'exists:categories,id',
        ], ['danh_muc.exists' => 'Danh mục sản phẩm không hợp lệ!']);
        if ($validator->fails()) {
            return redirect(route('admin.product.create'))->withErrors($validator, 'danh_muc')->withInput();
        }
    }

    public function store(CreateProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $seo = Seo::create([
                'title' => $request->input('seo_tieu_de'),
                'alias' => $request->input('seo_alias'),
            ]);
            if ($request->has('seo_mo_ta')) {
                $seo->desc = $request->input('seo_mo_ta');
            }
            $product = Product::create([
                'name' => $request->input('ten_san_pham'),
                'imprice' => $request->has('gia_nhap') ? $request->input('gia_nhap') : 0,
                'price' => $request->has('gia_ban') ? $request->input('gia_ban') : 0,
                'sale' => $request->has('giam_gia') ? $request->input('giam_gia') : 0,
                'status' => $request->has('trang_thai') ? ($request->input('trang_thai') == 1 ? 1 : 0) : 0,
                'mark' => $request->has('danh_dau') ? $request->input('danh_dau') : 0,
                'seoid' => $seo->id,
            ]);
            if ($request->has('mo_ta')) {
                $product->shortdesc = $request->input('mo_ta');
            }
            if ($request->has('bai_viet')) {
                $product->longdesc = $request->input('bai_viet');
            }
            if (($images = $request->file('hinh_anh')) != null) {
                if (!is_array($images)) {
                    $thumb = $this->addImage($images, $product->id, $request->input('seo_alias'));
                    $product->thumb = $thumb;
                } else {
                    foreach ($images as $position => $image) {
                        $thumb = $this->addImage($image, $product->id, $request->input('seo_alias'));
                        if ($position == 0) {
                            $product->thumb = $thumb;
                        }
                    }
                }
            }
            if ($request->has('danh_muc') && $request->input('danh_muc') != 0) {
                $this->validatorCateogryExist($request);
                $product->categoryid = $request->input('danh_muc');
            }
            $product->save();
            DB::commit();
        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        }
        $message = ViewController::createMessage("Thêm sản phẩm '$product->name' thành công!");
        $message['id'] = $product->id;
        return response()->json($message, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            $msg = ViewController::createMessage('Không tồn tại sản phẩm này!', 'danger');
        } else {
            if (file_exists($product->thumb) && $product->thumb != DEFAULT_THUMB) {
                unlink($product->thumb);
            }
            $images = $product->images;
            foreach ($images as $key => $image) {
                if (file_exists($image->url)) {
                    unlink($image->url);
                }
                $image->delete();
            }
            $seo = $product->seo();
            $product->delete();
            $seo->delete();
            $msg = ViewController::createMessage("Xóa sản phẩm '$product->name' thành công!");
        }
        return redirect(route('admin.product.index'))->with(MESSAGE, $msg);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return ViewController::view('admin.product.edit', 'Chỉnh sửa sản phẩm', 'Chỉnh sửa thông tin sản phẩm')
            ->with(['categories' => $categories, 'product' => $product]);
    }

    public function update($id, UpdateProductRequest $request)
    {
        $product = Product::find($id);
        if ($product == null) {
            $message = ViewController::createMessage('Không tồn tại sản phẩm này!');
            return redirect(route('admin.product.index'))->with([MESSAGE => $message]);
        }
        if ($request->input('seo_alias') != $product->seo->alias) {
            $validator = Validator::make($request->all(), [
                'seo_alias' => 'unique:seos,alias',
            ], ['seo_alias.unique' => 'Bí danh này đã tồn tại, vui lòng chọn bí danh khác!']);
            if ($validator->fails()) {
                return redirect(route('admin.product.edit', $id))->withErrors($validator, 'seo_alias')->withInput();
            }
        }
        DB::beginTransaction();
        try {
            $seo = $product->seo;
            $seo->title = $request->input('seo_tieu_de');
            $seo->alias = $request->input('seo_alias');
            if ($request->has('seo_mo_ta')) {
                $seo->desc = $request->input('seo_mo_ta');
            }
            $product->name = $request->input('ten_san_pham');
            $product->imprice = $request->has('gia_nhap') ? $request->input('gia_nhap') : 0;
            $product->price = $request->has('gia_ban') ? $request->input('gia_ban') : 0;
            $product->sale = $request->has('giam_gia') ? $request->input('giam_gia') : 0;

            if ($request->has('mo_ta')) {
                $product->shortdesc = $request->input('mo_ta');
            }
            if ($request->has('bai_viet')) {
                $product->longdesc = $request->input('bai_viet');
            }
            if ($request->has('trang_thai')) {
                $product->status = $request->input('trang_thai') == 1 ? 1 : 0;
            }
            if ($request->has('danh_dau')) {
                $product->mark = $request->input('danh_dau');
            }
            if ($request->has('danh_muc') && $request->input('danh_muc') != 0) {
                $this->validatorCateogryExist($request);
                $product->categoryid = $request->input('danh_muc');
            }
            $product->save();
            DB::commit();
        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        }
        $message = ViewController::createMessage("Chỉnh sửa sản phẩm '$product->name' thành công!");
        return redirect(route('admin.product.index'))->with([MESSAGE => $message]);
    }
}
