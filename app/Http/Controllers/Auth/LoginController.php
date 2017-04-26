<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Route;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /** @var string $guard */
    protected $guard;

    /** Create a new controller instance. */
    public function __construct()
    {
        $this->guard = $this->mapFromRoute();
        $this->middleware('guest')->except('logout');
    }

    /** @inheritdoc */
    public function showLoginForm()
    {
        return view('admin_index');
    }

    /** @inheritdoc */
    protected function authenticated(Request $request, $user)
    {
        if($request->expectsJson()) {
            return $this->authenticatedJson($user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Json response for authenticated
     *
     * @param \App\Models\User $authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticatedJson($authenticated)
    {
        return response()->json([
            'user' => $authenticated,
        ]);
    }

    /** @inheritdoc */
    protected function redirectPath()
    {
        /** @var \App\Models\User $authenticated */
        $authenticated = $this->guard()->user();

        if (!$authenticated || !$authenticated->currentRole()->isAdmin()) {
            return route('web.homepage');
        }

        return route('admin.dashboard');
    }

    /**
     * Get guard from route
     *
     * @return string Name of current guard
     */
    protected function mapFromRoute()
    {
        $currentRoute = Route::getCurrentRoute();

        if ($currentRoute) {
            $action = $currentRoute->getAction();
            return isset($action['auth']) && $action['auth'] ? $action['auth'] : config('auth.defaults.guard');
        }

        return config('auth.defaults.guard');
    }

    /** @inheritdoc */
    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
