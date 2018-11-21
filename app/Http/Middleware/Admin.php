<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::check()) // Check if the user is logged in
        {
            if (Auth::user()->isAdmin()) // Check if the logged user is an Administrator
            {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
