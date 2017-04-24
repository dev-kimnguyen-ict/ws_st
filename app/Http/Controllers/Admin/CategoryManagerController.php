<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * [GET] Show list of data model, the page manager.
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return ViewController::view('admin.category.index', 'Quản lý danh mục', 'Trang quản lý danh mục sản phẩm')
            ->with(['categories' => $categories]);
    }

    /**
     * [GET] Show form create account
     */
    public function create()
    {
        $categories = Category::all();
        return ViewController::view('admin.category.create', 'Thêm mới danh mục', 'Thêm mới một danh mục vào cơ sở dữ liệu')
            ->with('categories', $categories);
    }

    private function validatorCateogryExist($request)
    {
        $validator = Validator::make($request->all(), [
            'danh_muc_cha' => 'exists:categories,id',
        ], ['danh_muc_cha.exists' => 'Danh mục cha không hợp lệ!']);
        if ($validator->fails()) {
            return redirect(route('admin.category.create'))->withErrors($validator, 'danh_muc_cha')->withInput();
        }
    }

    /**
     * [POST] Process insert account register to database.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    function store(CreateCategoryRequest $request)
    {
        if ($request->has('danh_muc_cha') && ($parentID = $request->input('danh_muc_cha')) != 0) {
            $this->validatorCateogryExist($request);
        }

        DB::beginTransaction();
        try {
            $seo = Seo::create([
                'title' => $request->input('seo_tieu_de'),
                'alias' => $request->input('seo_alias'),
            ]);
            if ($request->has('seo_mo_ta')) {
                $seo->desc = $request->input('seo_mo_ta');
            }
        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        }
        try {
            $category = new Category();
            $category->name = $request->input('ten_danh_muc');
            if ($request->has('trang_thai')) {
                $category->status = $request->input('trang_thai');
            }
            if ($request->has('mo_ta')) {
                $category->desc = $request->input('mo_ta');
            }
            $category->seoid = $seo->id;
            if ($request->has('danh_muc_cha') && $parentID != 0) {
                $category->parentid = $parentID;
            }
            $category->save();
            DB::commit();
        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        }
        $message = ViewController::createMessage("Thêm danh mục '$category->name' thành công!");
        return redirect(route('admin.category.index'))->with(MESSAGE, $message);
    }

    /**
     * [DELETE] Delete account
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            $message = ViewController::createMessage('Không tồn tại danh mục này', 'danger');
        } else {
            $seo = $category->seo();
            $category->delete();
            $seo->delete();
            $message = ViewController::createMessage("Xóa danh mục '$category->name' thành công!");
        }
        return redirect(route('admin.category.index'))->with(MESSAGE, $message);
    }

    /**
     * [PUT] Process request post and update information of record to database
     *
     * @param $id
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function update($id, UpdateCategoryRequest $request)
    {
        // TODO: process avatar upload
        $category = Category::find($id);
        if ($category != null) {
            $category->name = $request->has('ten_danh_muc') ? $request->input('ten_danh_muc') : $category->name;
            $category->status = $request->has('trang_thai') ? $request->input('trang_thai') : $category->status;
            $category->desc = $request->input('mo_ta');
            if ($request->has('danh_muc_cha')) {
                if ($request->input('danh_muc_cha') != 0) {
                    $this->validatorCateogryExist($request);
                    $category->parentid = $request->input('danh_muc_cha');
                } else {
                    $category->parentid = null;
                }
            }
            $seo = Seo::find($category->seoid);
            $seo->title = $request->has('seo_tieu_de') ? $request->input('seo_tieu_de') : $seo->title;
            $seo->desc = $request->has('seo_mo_ta') ? $request->input('seo_mo_ta') : null;
            $seo->alias = $request->has('seo_alias') ? $request->input('seo_alias') : $seo->alias;
            $category->save();
            $seo->save();
            $message = ViewController::createMessage('Thay đổi thông tin thành công!');
        } else {
            $message = ViewController::createMessage('Không tồn tại danh mục sản phẩm này!');
        }
        return redirect(route('admin.category.index'))->with(MESSAGE, $message);
    }

    /**
     * [GET] Show the detail object model.
     */
    // function show($id){
    //     $account = User::find($id);
    //     return ViewController::view( 'admin.account.show', 'Chi tiết tài khoản',
    //                 'Hiển thị tất cả thông tin chi tiết của tài khoản')->with(['account' => $account]);
    // }

    /**
     * [GET] Get the edit UI (user interface)
     *
     * @param $id
     * @return $this
     */
    function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return ViewController::view('admin.category.edit', 'Chỉnh sửa danh mục', 'Thay đổi thông tin danh mục')
            ->with(['category' => $category, 'categories' => $categories]);
    }

    /**
     * [GET] Filte account
     *
     * @param Request $request
     */
    public function filter(Request $request)
    {
        // Filter If dont have id or name:
        if (!$request->has('ma_so') && !$request->has('ten_danh_muc')) {
            return $this->index();
        } // Filter if has a id or has name:
        else {
            if ($request->has('ma_so')) {
                $categories = Category::where('id', $request->input('ma_so'));
            } else {
                $name = $request->input('ten_danh_muc');
                $categories = Category::where('name', 'like', "%{$name}%");
            }
        }
        $curentUrl = $request->getUri();
        $categories = $categories->paginate(20)
            ->setPath($curentUrl);
        return ViewController::view('admin.category.index', 'Quản danh mục', 'Trang quản lý danh mục sản phẩm')
            ->with(['categories' => $categories]);
    }
}
