<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 23/04/2017
 * Time: 09:53
 */

namespace App\Models\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CurrentRole
{
    /** @var  User $user */
    protected $user;

    public function __construct(Model $user)
    {
        $this->user = $user;
    }

    /** @return bool */
    public function isAdmin()
    {
        return $this->user->role_id == User::ADMIN;
    }

    /** @return bool */
    public function isUser()
    {
        return $this->user->role_id == User::USER;
    }
}
