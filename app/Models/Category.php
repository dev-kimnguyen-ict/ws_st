<?php

namespace App\Models;

use App\Models\Collections\CategoryCollection;
use App\Models\Traits\Multilevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * Class Category
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $parent_id
 * @property string $ancestor_path
 * @property bool $active
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    use Multilevel,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'active',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Custom collection
     *
     * @param array $models
     * @return CategoryCollection
     */
    public function newCollection(array $models = [])
    {
        return new CategoryCollection($models);
    }

    /**
     * Build category
     *
     * @param Request $request
     * @param Category|null $category
     * @return Category
     */
    public static function makeFromRequest(Request $request, $category = null)
    {
        $category = $category ?: new Category();
        $parentId = $request->get('parent_id');
        $parentId = $parentId ?: null;

        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->parent_id = $parentId;
        $category->active = $request->get('active');
        $category->generateAncestorPath();

        return $category;
    }
}
