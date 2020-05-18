<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAccessPanel
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
        if (Auth::check() && Auth::user()->role != "user") {
            return $next($request);
        }else{
            Auth::logout();
            return redirect('login')->with('error', "No tienes acceso al panel");
        }
    }
}
