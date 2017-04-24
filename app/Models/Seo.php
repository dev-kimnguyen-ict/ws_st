<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seo
 *
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $robots
 * @property string $revisit_after
 * @property string $alias
 * @property string $created_at
 * @property string $updated_at
 */
class Seo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc',
        'alias',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'seoid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'seoid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function seoable()
    {
        return $this->morphTo();
    }
}
