<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 29/04/2017
 * Time: 14:30
 */

namespace App\Components\Uploader;

use Illuminate\Queue\SerializesModels;

class UploadedFile extends \Illuminate\Http\UploadedFile
{
    use SerializesModels;
}
