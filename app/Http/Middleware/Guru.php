<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Guru
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
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role == 2){
            return redirect()->route('siswa');
        } else {
            return redirect()->route('home');
        }

        
    }
}
