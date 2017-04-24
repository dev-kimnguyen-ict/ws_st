<?php

namespace App\Http\Controllers\Traits;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seo;

trait TemplateViews
{
    protected function view($view, $data = [])
    {
        $products = Product::all();
        $max = $products->count() > 6 ? 6 : $products->count();
        $categories = Category::all();
        $randProducts = $products->count() > 0 ? $products->random($max) : collect([]);
//        $randProducts = count($data['randProducts']) < 2 ? collect([$data['randProducts']]) : $data['randProducts'];

        return view($view, array_merge($data, compact('categories', 'randProducts')));
    }

    /**
     * [findSeo description]
     *
     * @param  [type] $alias [description]
     * @return [type]        [description]
     */
    protected function findSeo($alias)
    {
        return Seo::where('alias', $alias)->first();
    }
}
