<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function removeImageProduct($productID, Request $request)
    {
        $product = Product::find($productID);
        if ($product == null) {
            return response()->json(['error' => 'Không tồn tại sản phẩm này!'], 200);
        }
        $imageID = $request->input('id');
        $image = Image::find($imageID);
        if ($image) {
            DB::beginTransaction();
            try {
                if (file_exists($image->url)) {
                    unlink($image->url);
                }
                $image->delete();
                if (count($product->images) == 0) {
                    $product->thumb = 'images/default.png';
                } else if ($product->thumb = $image->url) {
                    $product->thumb = Image::where('productid', $productID)->first()->url;
                }
                $product->save();
                DB::commit();
            } catch (ValidationException $e) {
                DB::rollback();
                throw $e;
            }
            return response()->json(['message' => 'Xóa hình ảnh thành công!', 'total' => count(Product::find($productID)->images)], 200);
        }
    }

    public function saveImageProduct($productID, Request $request)
    {
        $product = Product::find($productID);
        if ($product == null) {
            return response()->json(['error' => 'Không tồn tại sản phẩm này!'], 200);
        }
        DB::beginTransaction();
        try {
            if (($image = $request->file('hinh_anh')) != null) {
                $alias = $product->seo->alias;
                $num = count($product->images);
                $url = $this->addImage($image, $productID, "$alias");
                if ($num == 0) {
                    $product->thumb = $url;
                }
                $product->save();
            }

            DB::commit();
        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        }

        return response()->json([
            'message' => 'Thêm hình ảnh thành công!',
            'image' => Product::find($productID)->images->last(),
        ], 200);
    }

    private function moveFileToDir($image, $pathname, $thumb = false)
    {
        $filename = $pathname . '.' . $image->getClientOriginalExtension();
        $dir = $thumb ? UPLOAD_DIR_THUMB : UPLOAD_DIR;
        while (file_exists($dir . '/' . $filename)) {
            $filename = $pathname . "-" . str_slug(microtime()) . '.' . $image->getClientOriginalExtension();
        }
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
}
