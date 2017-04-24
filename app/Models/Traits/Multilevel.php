<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 14:45
 */

namespace App\Models\Traits;

use App\Models\Category;

/**
 * Class Multilevel
 *
 * @package App\Models\Traits
 */
trait Multilevel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /** @return bool Has parent */
    public function hasParent()
    {
        return !!$this->parent_id;
    }

    /** @return bool Has children */
    public function hasChildren()
    {
        if (!$this->relationLoaded('children')) {
            $this->load('children');
        }

        return $this->children->count() > 0;
    }

    /** @return string */
    public function getPathKeyAttribute()
    {
        return str_pad($this->getKey(), 10, '0', STR_PAD_LEFT);
    }

    /** @return string */
    public function getDescendantPathAttribute()
    {
        return trim("{$this->ancestor_path}.{$this->pathKey}", '.');
    }

    /** @return int */
    public function getLevelAttribute()
    {
        return !$this->ancestor_path ? 1 : substr_count($this->ancestor_path, '.') + 2;
    }

    /** Generate ancestor path if need */
    public function generateAncestorPath()
    {
        if ($this->parent_id && !$this->ancestor_path) {
            $this->ancestor_path = self::find($this->parent_id)->descendantPath;
        }
    }
}
