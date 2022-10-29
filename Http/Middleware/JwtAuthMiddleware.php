<?php

namespace Modules\JwtApi\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Modules\JwtApi\Services\HttpResponseJson;
use Modules\JwtApi\Exceptions\JwtApiException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JwtAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        try {

            JWTAuth::parseToken()->authenticate();

            return $next($request);
        } catch (Exception $th) {
            if ($th instanceof TokenExpiredException) {
                return HttpResponseJson::error(TokenExpiredException::class, 'Token is Expired', 401);
            } elseif ($th instanceof TokenInvalidException) {
                return HttpResponseJson::error(TokenInvalidException::class, 'Token is Invalid', 401);
            } elseif ($th instanceof JWTException) {
                return HttpResponseJson::error(JWTException::class, 'Token Not Provided', 401);
            } elseif ($th instanceof TokenBlacklistedException) {
                return HttpResponseJson::error(TokenBlacklistedException::class, 'Token has been blacklisted', 401);
            } else {
                return HttpResponseJson::error(JwtApiException::class, 'Authorization Token not found', 401);
            }
        }
    }
}
