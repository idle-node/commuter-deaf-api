<?php

namespace App\Http\Middleware\Api;

use App\Facade\BaseResponse;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class AccessTokenGuard
{
    /**
     * exception
     * 
     * All APIs will be guarded by providing access token, 
     * except for every routes inside this array below.
     */
    private array $exception = [
        'api',
        'api/uma/auth/login',
        'api/uma/user',
        'api/uma/user/otp'
    ];

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
        $uri_not_inside_exception = (!in_array($request->route()->uri, $this->exception));
        $token_not_provided = ($request->header('Authorization') === null);

        /**
         * Scenario where the client is access unprotected uri.
         */
        if(!$uri_not_inside_exception){

            return $next($request);

        }else 

        /**
         * Scenario where the client trying to access
         * URI that doesn't even exist in exception.
         * 
         * And the client does provide the token.
         */
        if(!$uri_not_inside_exception || !$token_not_provided){

            return $next($request);

        }else

        /**
         * Scenario where the client is trying to a accessing 
         * URI that has is protected, and the client didn't 
         * provide any Bearer token.
         */
        if($uri_not_inside_exception && $token_not_provided){
            return  BaseResponse::custom(403, "You're forbid to access this protected resource!");
        }else{

            /**
             * The only left is,
             * if client trying to access unprotected token,
             * but still provide the token.
             */
            return $next($request);
        }
    }
}
