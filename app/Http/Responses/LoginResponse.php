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


        if (Auth::user()->role === 'SPV') {
            return redirect()->intended(config('fortify.supervisor'));
        } elseif (Auth::user()->role === 'Admin Gudang') {
            return redirect()->intended(config('fortify.admin-gudang'));
        } elseif (Auth::user()->role === 'Kepala Gudang') {
            return redirect()->intended(config('fortify.kepala-gudang'));
        }

        // return $request->wantsJson()
        //     ? response()->json(['two_factor' => false])
        //     : redirect()->intended(config('fortify.admin-gudang'));
    }
}
