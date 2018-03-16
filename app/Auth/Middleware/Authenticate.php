<?php

namespace App\Auth\Middleware;

use ApiAuth;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    protected $except = [
        'auth/sign'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->inExceptArray($request)) {
            return $next($request);
        } else {
            $token = $request->bearerToken();

            if ($token) {
                $result = ApiAuth::verifyToken($token);

                return $result ? $next($request) : abort(401, 'Token invalid.');
            } else {
                abort(400, 'The HTTP Authorization request header is required.');
            }
        }
    }

    /**
     * Determine if the request has a URI that should pass.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray(Request $request): bool
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
