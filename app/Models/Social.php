<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Social
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $avatar_url
 * @property string $user_provider_id
 * @property string $provider
 * @property string $created_at
 * @property string $updated_at
 */
class Social extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'avatar_url',
        'service_id',
        'service',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Find social by service id
     *
     * @param string $userProviderId
     * @param string $provider
     * @return Social
     */
    public static function findByServiceId($userProviderId, $provider)
    {
        return self::where('user_provider_id', $userProviderId)
            ->where('provider', $provider)
            ->first();
    }
}
