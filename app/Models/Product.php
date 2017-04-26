<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

/**
 * Class Product
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $thumbnail
 * @property double $price
 * @property int $discount
 * @property string $description
 * @property string $content
 * @property int $view
 * @property int $mark_as
 * @property int $category_id
 * @property bool $active
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'thumbnail',
        'price',
        'discount',
        'description',
        'content',
        'view',
        'mark_as',
        'category_id',
        'active',
    ];

    /**
     * Casts field type
     *
     * @var array
     */
    protected $casts = [
        'active' => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    /**
     * Format string to numeric
     *
     * @param string|null $value
     */
    public function setPriceAttribute($value = null)
    {
        $value = $value ? str_replace(',', '', $value) : null;
        $this->attributes['price'] = $value;
    }

    /**
     * Html escape input
     *
     * @param string|null $value
     */
    public function setContentAttribute($value = null)
    {
        $value = $value ? htmlentities($value) : null;
        $this->attributes['content'] = $value;
    }

    /**
     * Html escape input
     *
     * @param string|null $value
     */
    public function setDescriptionAttribute($value = null)
    {
        $value = $value ? htmlentities($value) : null;
        $this->attributes['description'] = $value;
    }

    /**
     * Make from request
     *
     * @param Request $request
     * @param Product|null $product
     * @return Product
     */
    public static function makeFromRequest(Request $request, Product $product = null)
    {
        $product = $product ?: new self();

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->discount = $request->get('discount');
        $product->description = $request->get('description');
        $product->content = $request->get('content');
        $product->view = $request->get('view');
        $product->mark_as = $request->get('mark_as');
        $product->category_id = $request->get('category_id') ?: null;
        $product->active = $request->get('active');
        $product->thumbnail = $request->get('thumbnail');

        return $product;
    }
}
