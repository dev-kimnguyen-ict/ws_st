<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageInfo(trans('labels.product.title.index'), trans('labels.product.sub.index'));
        $products = Product::paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageInfo(trans('labels.product.title.create'), trans('labels.product.sub.create'));
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Show edit form
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $this->setPageInfo(trans('labels.product.title.edit'), trans('labels.product.sub.edit'));
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::makeFromRequest($request);
        $seo = Seo::makeFromRequest($request);
        dd($product->toArray(), $seo->toArray());
//        $product->save();
    }

    public function update($id, UpdateProductRequest $request)
    {
        dd($request->all());
        return redirect()->route('admin.product.index');
    }

    /**
     * Delete product
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.product.index'))->with(success(trans('alert.success')));
    }
}
