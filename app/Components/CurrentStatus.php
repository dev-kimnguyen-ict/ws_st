<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 17:14
 */

namespace App\Components;

use App\Models\User;

class CurrentStatus
{
    /** @var  User $user */
    protected $model;

    /** @return bool */
    public function isBlocked()
    {
        return !!$this->model->blocked;
    }

    /** @return bool */
    public function isActive()
    {
        return !!$this->model->active;
    }
}
