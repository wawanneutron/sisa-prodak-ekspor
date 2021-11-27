<?php

namespace App\Http\Controllers\KepalaGudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.kepala-gudang.pengajuan.index');
    }
}
