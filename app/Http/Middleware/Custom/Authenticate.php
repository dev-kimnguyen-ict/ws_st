<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return $request->ajax() || $request->wantsJson()
                ? response('Unauthorized.', 401)
                : redirect()->guest('login');
        }

        return $next($request);
    }
}
