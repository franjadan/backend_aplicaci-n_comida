<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActiveUser
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
        if (Auth::check() && Auth::user()->active == true) {
            return $next($request);
        }else{
            Auth::logout();
            return redirect('login')->with('error', "Has sido inhabilitado por el sistema");
        }
    }
}
