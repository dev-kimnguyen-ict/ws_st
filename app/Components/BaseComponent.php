<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 17:30
 */

namespace App\Components;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseComponent
 *
 * @package App\Models\Components
 */
abstract class BaseComponent
{
    /** @var Model $model */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
