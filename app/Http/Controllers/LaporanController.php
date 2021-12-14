<?php

namespace App\Http\Controllers;

use App\Models\Aproval;
use App\Models\OverProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function laporanProduct()
    {
        $dataProduct = DB::table('products')->get();
        $pdf = PDF::loadView('pages.dashboard.laporan.product.index', [
            'data' => $dataProduct
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('data-product.pdf');
    }

    public function printProduct($id)
    {
        $product = DB::table('products')->find($id);
        $pdf = PDF::loadView('pages.dashboard.laporan.product.print', compact('product'));
        return $pdf->stream("print_$product->no_po.pdf");
    }

    public function laporanBarangLebih()
    {
        $dataOver = OverProduct::all();
        $pdf = PDF::loadView('pages.dashboard.laporan.over.index', [
            'data' => $dataOver
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('data-barang-lebih.pdf');
    }

    public function printBarangLebih($id)
    {
        $dataOver = OverProduct::find($id);
        $pdf = PDF::loadView('pages.dashboard.laporan.over.print', [
            'product' => $dataOver
        ])->setPaper('a4', 'landscape');
        return $pdf->stream("print_$dataOver->over_product_id.pdf");
    }

    public function laporanPengajuan()
    {
        $aproval = Aproval::all();
        $pdf = PDF::loadView('pages.dashboard.laporan.pengajuan.index', [
            'data' => $aproval
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('data-pengajuan.pdf');
    }

    public function printPengajuan($id)
    {
        $aproval = Aproval::find($id);
        $pdf = PDF::loadView('pages.dashboard.laporan.pengajuan.print', [
            'data' => $aproval
        ])->setPaper('a4', 'landscape');
        return $pdf->stream("print_$aproval->kd_pengajuan.pdf");
    }
}
