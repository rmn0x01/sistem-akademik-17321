<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Siswa
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
        if (Auth::check() && Auth::user()->role == 0){
            return redirect()->route('admin');
        } elseif (Auth::check() && Auth::user()->role == 1){
            return redirect()->route('guru');
        } elseif (Auth::check() && Auth::user()->role == 2){
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
