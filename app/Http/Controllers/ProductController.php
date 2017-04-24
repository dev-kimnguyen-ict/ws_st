<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TemplateViews;
use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TemplateViews;

    public function category($categoryAlias, Request $request)
    {
        $seo = $this->findSeo($categoryAlias);
        if ($seo == null) {
            abort(404);
        }
        $category = $seo->category;
        $products = Product::where('categoryid', $category->id)->paginate(20)->setPath($request->getUri());
        return $this->view('app.product.by_category', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function detail($categoryAlias, $productAlias)
    {
        $seoCategory = $this->findSeo($categoryAlias);
        $seoProduct = $this->findSeo($productAlias);
        if ($seoCategory == null || $seoProduct == null) {
            abort(404);
        }
        $product = $seoProduct->product;
        $product->viewed++;
        $product->save();
        return $this->view('app.product.detail', [
            'product' => $product,
        ]);
    }

    public function new(Request $request)
    {
        $products = Product::where('mark', MARK_NEW)->paginate(20)->setPath($request->getUri());
        return $this->view('app.product.new', [
            'title' => 'Sản phẩm mới',
            'products' => $products,
        ]);
    }

    public function featured(Request $request)
    {
        $products = Product::where('mark', MARK_FEATURED)->paginate(20)->setPath($request->getUri());
        return $this->view('app.product.new', [
            'title' => 'Sản phẩm nổi bật',
            'products' => $products,
        ]);
    }

    public function search(SearchRequest $request)
    {
        $key = $request->input('q');
        $products = Product::where('name', 'like', "%{$key}%")
            ->paginate(20)
            ->setPath($request->getUri());
        return $this->view('app.product.search', [
            'products' => $products,
            'key' => $key,
        ]);
    }
}
