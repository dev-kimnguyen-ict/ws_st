<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 15:14
 */

if (!function_exists('success')) {
    function success($_message)
    {
        $_status = 'alert-success';
        return compact('_message', '_status');
    }
}

if (!function_exists('warning')) {
    function warning($_message)
    {
        $_status = 'alert-warning';
        return compact('_message', '_status');
    }
}

if (!function_exists('danger')) {
    function danger($_message)
    {
        $_status = 'alert-danger';
        return compact('_message', '_status');
    }
}
