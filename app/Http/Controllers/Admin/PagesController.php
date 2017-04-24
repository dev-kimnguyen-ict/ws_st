<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        return ViewController::view('admin.dashboard', 'Bảng điều khiển', 'Trang quản lý hệ thống');
    }

}
