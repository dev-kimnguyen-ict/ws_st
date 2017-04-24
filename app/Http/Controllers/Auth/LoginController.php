<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** @inheritdoc */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }

    /** @inheritdoc */
    public function redirectPath()
    {
        return Auth::user()->currentRole()->isAdmin() ? route('admin.dashboard') : route('web.homepage');
    }
}
