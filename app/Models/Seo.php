<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

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
    use SoftDeletes;

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function seoable()
    {
        return $this->morphTo();
    }

    /**
     * Make seo
     *
     * @param Request $request
     * @param Seo|null $seo
     * @return Seo
     */
    public static function makeFromRequest(Request $request, $seo = null)
    {
        $seo = $seo ?: new self();

        $seo->title = $request->get('seo_title');
        $seo->description = $request->get('seo_description');
        $seo->alias = $request->get('seo_alias');

        return $seo;
    }
}
