<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
    }
}
