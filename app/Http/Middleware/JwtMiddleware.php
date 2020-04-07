<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) { 
                throw new Exception("User Not Found");
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'message' => 'token_invalid'
                ], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'message' => 'token_expired'
                ],401); 
            } else if ($e->getMessage() === 'User Not Found') {
                return response()->json([
                    'message' => 'not_found'
                ],404);
            } else {
                return response()->json( [
                    'message' => 'token_not_found'
                ], 401);
            }
        }
        return $next($request);   
    }
}
