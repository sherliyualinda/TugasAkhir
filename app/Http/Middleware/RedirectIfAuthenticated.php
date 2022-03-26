<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
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
        if (Auth::guard($guard)->check()) {
            // dd(Auth::guard($guard));
            // dd(Auth::user()->email);
            if(Auth::user()->id_role == 1){
                return redirect('/sosial-media/dashboard-admin');
            }
            return redirect('/sosial-media/beranda');
        }

        return $next($request);
    }
	
}