<?php

namespace App\Http\Middleware\Oauth;

use Closure;
use Route;

/**
* InjectClientSecretToRequest
*/
class InjectApiTokenToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard && $this->authGuard()->check()) {
            dd($guard, $this->authGuard()->user());
        }

        return $next($request);
    }

    protected function authGuard()
    {
        $guard = $this->getGuardFromRoute();
        return Auth::guard($guard);
    }

    /**
     * Get guard name from route defined
     *
     * @return string
     */
    protected function getGuardFromRoute()
    {
        $currentRoute = Route::getCurrentRoute();

        if ($currentRoute) {
            $action = $currentRoute->getAction();
            return isset($action['guard']) && $action['guard'] ? $action['guard'] : config('auth.defaults.guard');
        }

        return config('auth.defaults.guard');
    }
}

