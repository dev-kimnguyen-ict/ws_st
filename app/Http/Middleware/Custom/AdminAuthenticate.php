<?php

namespace App\Http\Middleware\Custom;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user) {
            return $user->currentRole()->isAdmin() && !$user->blocked
                ? $next($request)
                : redirect('/')->with(['message' => ['status' => 'danger', 'message' => 'Forbidden']]);
        }

        return redirect()->guest('login');
    }
}
