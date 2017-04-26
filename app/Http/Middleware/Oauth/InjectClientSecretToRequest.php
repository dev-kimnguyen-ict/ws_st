<?php

namespace App\Http\Middleware\Oauth;

use Closure;

/**
* InjectClientSecretToRequest
*/
class InjectClientSecretToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Validate if the request is a password grant
        if ($request->grant_type == 'password') {
            // Then adding the client secret so its not publicly visible
            $request->request->add([
                'client_id' => config('app.client_id'),
                'client_secret' => config('app.client_secret')
            ]);
        }

        return $next($request);
    }
}

