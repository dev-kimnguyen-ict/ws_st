<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 23/04/2017
 * Time: 09:51
 */

namespace App\Models\Contracts;

interface UserContract
{
    const ADMIN = 1;
    const USER = 5;
    const MALE = 1;
    const FEMALE = 2;

    /**
     * Get full name
     *
     * @return string|null
     */
    public function getFullName();

    /**
     * Get identifier string
     *
     * @return string
     */
    public function getIdentifier();
}
