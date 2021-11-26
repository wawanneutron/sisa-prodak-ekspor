<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        $cek = Auth::user()->role;

        switch ($cek) {
            case 'Admin Gudang':
                return redirect()->intended(config('fortify.admin-gudang'));

                break;
            case 'Supervisor':
                return redirect()->intended(config('fortify.supervisor'));

                break;
            case 'Kepala Gudang':
                return redirect()->intended(config('fortify.supervisor'));

                break;
            default:
                return route('login');
                break;
        }

        /* default bawaan fortify */
        // return $request->wantsJson()
        //     ? response()->json(['two_factor' => false])
        //     : redirect()->intended(config('fortify.home'));
    }
}
