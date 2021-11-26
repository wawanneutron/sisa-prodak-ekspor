<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $role = Auth::user()->role;
                /* menghandle redirect setelah login sesuai dengan role */
                switch ($role) {
                    case 'Kepala Gudang':
                        # code...
                        return redirect(RouteServiceProvider::KEPALAGUDANG);
                        break;

                    case 'SPV':
                        # code...
                        return redirect(RouteServiceProvider::SPV);
                        break;

                    case 'Admin Gudang':
                        # code...
                        return redirect(RouteServiceProvider::ADMINGUDANG);
                        break;
                    default:
                        # code...
                        return route('login');
                        break;
                }
            }
        }
        return $next($request);
    }
}
