<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AdminUnauthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!(Auth::guard($guard)->check()) || Auth::user()->type != 'admin') {

            if (Auth::guard($guard)->check()) {
                Auth::logout();
            }

            return redirect()->guest('admin/login')->withErrors('You are not logged in.');
        }

        return $next($request);
    }
}
