<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 23/04/2017
 * Time: 09:53
 */

namespace App\Components;

use App\Models\User;

/**
 * Class CurrentRole
 *
 * @package App\Models\Components
 */
class CurrentRole extends BaseComponent
{
    /** @var  User $model */
    protected $model;

    /** @return bool */
    public function isAdmin()
    {
        return $this->model->role_id == User::ADMIN;
    }

    /** @return bool */
    public function isUser()
    {
        return $this->model->role_id == User::USER;
    }
}
