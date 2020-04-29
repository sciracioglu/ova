<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        //dd(session()->all());
        if (!session()->has('kullanici.username')) {
            return redirect()->guest('/login');
        }
        return $next($request);
    }
}
