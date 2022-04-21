<?php

namespace App\Http\Middleware;

use Closure;

class IsHr
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
        if (auth()->user() && auth()->user()->role_type == 'HR' && auth()->user()->active == '1') {
            return $next($request);
        }
        return redirect('/');
    }
}
