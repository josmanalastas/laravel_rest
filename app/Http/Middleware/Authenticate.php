<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use \Firebase\JWT\JWT;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response('Unauthorized.', 401);
        }
        $key = env("JWT_KEY", "salt");

        try {
            $JWTDetails = JWT::decode($token, $key, array('HS256'));
        } catch(\Exception $ex) {
            return response('Unauthorized.', 401);
        }

        return $next($request);

    }
}
