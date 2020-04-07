<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->user()->hasRole($role)) {
            return response()->json(['message' => 'unathorized'], 403);
        }
        return $next($request);
    }
}
