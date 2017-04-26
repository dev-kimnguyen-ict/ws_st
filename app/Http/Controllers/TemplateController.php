<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 29/04/2017
 * Time: 19:40
 */

namespace App\Http\Controllers;

class TemplateController extends Controller
{
    public function index()
    {
        return view('admin_index');
    }
}
