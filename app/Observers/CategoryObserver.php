<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 21:14
 */

namespace App\Observers;

use App\Models\Category;
use App\Models\Seo;

class CategoryObserver
{
    public function saving(Category $category)
    {
        $category->generateAncestorPath();
    }

    public function deleted(Category $category)
    {
        $childrenQuery = Category::whereRaw("ancestor_path REGEXP '^{$category->descendantPath}'");
        Seo::whereIn('id', $childrenQuery->get()->pluck('seo.id')->toArray())->delete();
        $category->seo()->delete();
        $childrenQuery->delete();
    }
}
