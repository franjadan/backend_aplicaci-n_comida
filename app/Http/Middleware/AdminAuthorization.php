<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthorization
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
        $user = auth()->user();

        if ($user->isAdmin()) {
            return next($request);
        }

        return redirect()->route('index');
    }
}
