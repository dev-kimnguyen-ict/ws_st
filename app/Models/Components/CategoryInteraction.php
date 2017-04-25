<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 17:29
 */

namespace App\Models\Components;

use App\Models\Category;

class CategoryInteraction extends BaseComponent
{
    public function store($data = [], $model = null)
    {
        return $model ? $model->update($data) : $this->create($data);
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        return Category::create($data);
    }
}
