<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    /** Where to redirect users after registration. */
    protected $redirectTo = '/home';

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|between:3,100',
            'email' => 'required|email|between:5,255|unique:users',
            'password' => 'required|between:8,32|confirmed',
            'phone' => 'required|between:10,20',
            'address' => 'required|between:5,255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }
}
