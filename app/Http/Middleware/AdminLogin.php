<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminLogin
{
    /**
     * Handle an incoming request. if not logged in redirect to admin log in
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        if(!Auth::guard($guard)->check()){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
