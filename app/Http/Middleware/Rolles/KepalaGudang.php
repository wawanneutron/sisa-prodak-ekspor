<?php

namespace App\Http\Middleware\Rolles;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepalaGudang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === 'Kepala Gudang') {
            return $next($request);
        }
        return redirect('/');
    }
}
