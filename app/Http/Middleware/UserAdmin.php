<?php

namespace App\Http\Middleware;

use Closure;

class UserAdmin
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
        if(auth()->check() && (auth()->user()->role_id == 2 || auth()->user()->role_id == 3))
            return redirect('/');
        return $next($request);       
    }
}
