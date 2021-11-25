<?php

namespace App\Http\Controllers\AdminGudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function statistik()
    {
        return view('pages.admin-gudang.dashboard.index');
    }
}
