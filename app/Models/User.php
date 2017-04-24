<?php

namespace App\Models;

use App\Models\Components\CurrentRole;
use App\Models\Contracts\UserContract;
use App\Models\Traits\Roleable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $phone
 * @property string $address
 * @property string $birthday
 * @property int $gender
 * @property bool $active
 * @property bool $blocked
 * @property string $remember_token
 * @property int $role_id
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable implements UserContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'phone',
        'address',
        'birthday',
        'gender',
        'avatar',
        'actived',
        'blocked',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'actived' => 'bool',
        'blocked' => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function social()
    {
        return $this->hasMany(Social::class);
    }

    /**
     * Get current role
     *
     * @return CurrentRole
     */
    public function currentRole()
    {
        return new CurrentRole($this);
    }
}
