<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TemplateViews;
use App\Models\Product;

class PagesController extends Controller
{
    use TemplateViews;

    public function index()
    {
        $newProducts = Product::where('mark', MARK_NEW)->orderBy('name', 'asc')->take(8)->get();
        $feaProducts = Product::where('mark', MARK_FEATURED)->orderBy('name', 'asc')->take(8)->get();

        return $this->view('app.page.home', [
            'newProducts' => $newProducts,
            'feaProducts' => $feaProducts,
        ]);
    }

    public function about()
    {
        return $this->view('app.page.about');
    }

    public function contact()
    {
        return $this->view('app.page.contact');
    }
}
