<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 27/04/2017
 * Time: 23:23
 */

namespace App\Models\Traits;

trait Uploadable
{
    /**
     * @return string
     */
    public function uploadPath()
    {
        return md5($this->getKey());
    }
}
