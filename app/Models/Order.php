<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App
 * @property int $id
 * @property string $customer
 * @property string $address
 * @property string $phone
 * @property string $note
 * @property int $product_count
 * @property double $amount
 * @property int $status
 * @property string $payment
 * @property string $payment_info
 * @property int $user_id
 * @property string $delivery_date
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer',
        'address',
        'phone',
        'note',
        'product_count',
        'amount',
        'status',
        'payment',
        'payment_info',
        'user_id',
        'delivery_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
