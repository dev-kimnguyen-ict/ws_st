<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property int $mark
 * @property int $category_id
 * @property bool $active
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    protected $table = 'products';
    protected $quatity = 0;
    protected $amount = 0;
    protected $fillable = [
        'name',
        'shortdesc',
        'longdesc',
        'thumb',
        'imprice',
        'price',
        'viewed',
        'status',
        'seoid',
        'categoryid',
    ];

    public function getQuatity()
    {
        return $this->quatity;
    }

    public function setQuatity($quatity)
    {
        $this->quatity = $quatity;
        $this->amount = $quatity * $this->price;
    }

    public function incre()
    {
        $this->quatity += 1;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'productid');
    }

    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seoid');
    }

}
