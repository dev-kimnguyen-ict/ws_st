<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'orderid');
    }
}
