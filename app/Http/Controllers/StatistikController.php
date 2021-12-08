<?php

namespace App\Http\Controllers;

use App\Models\Aproval;
use App\Models\OverProduct;
use App\Models\User;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $account        = User::count();
        $aproval        = Aproval::count();
        $overProduct    = OverProduct::count();
        $aprovalPending    = Aproval::where('kondisi', 'pending')->count();
        $aprovalNotChecked = Aproval::where('kondisi', 'not checked')->count();
        $aprovalAprove     = Aproval::where('kondisi', 'approved')->count();
        $aprovalNotAprove  = Aproval::where('kondisi', 'not approved')->count();

        return view('pages.index', compact(
            'account',
            'aproval',
            'overProduct',
            'aprovalPending',
            'aprovalNotChecked',
            'aprovalAprove',
            'aprovalNotAprove'
        ));
    }
}
