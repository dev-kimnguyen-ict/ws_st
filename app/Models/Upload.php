<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 23/04/2017
 * Time: 08:18
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Upload
 *
 * @package App\Models
 * @property int $id
 * @property int $uuid
 * @property int $owner_id
 * @property string $name
 * @property string $extension
 * @property string $size
 * @property string $path
 * @property string $mime
 * @property string $type
 * @property int $uploadable_id
 * @property string $uploadable_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $ready_at
 */
class Upload extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'owner_id',
        'name',
        'extension',
        'size',
        'path',
        'mime',
        'error',
        'ready_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function uploadable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
