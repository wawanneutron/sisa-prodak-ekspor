<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('pages.dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required',
            'qty'   => 'required',
            'tgl_produksi' => 'required',
            'tgl_export' => 'required',
            'export_country' => 'required',
            'expired' => 'required'
        ]);

        $length = 4;
        $newRandom = '';
        for ($i = 0; $i < $length; $i++) {
            $newRandom .= rand(0, 9);
        }
        $noPo = 'PO/' . date('d') . '/' . strtoupper(date('M')) . '/' . date('Y') . '/' . $newRandom;

        $product =  Product::create([
            'no_po' => $noPo,
            'nama_barang' => $request->nama_barang,
            'satuan' => 'karton',
            'qty' => $request->qty,
            'tgl_produksi' => $request->tgl_produksi,
            'tgl_export' => $request->tgl_export,
            'export_country' => $request->export_country,
            'expired' => $request->expired,
            'status' => 'export'
        ]);

        if ($product) {
            return redirect()->route('dashboard.data-products.index')
                ->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('dashboard.data-products.index')
                ->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->validate($request, [
            'nama_barang' => 'required',
            'qty'   => 'required',
            'tgl_produksi' => 'required',
            'tgl_export' => 'required',
            'export_country' => 'required',
            'expired' => 'required'
        ]);

        $product->update([
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'tgl_produksi' => $request->tgl_produksi,
            'tgl_export' => $request->tgl_export,
            'export_country' => $request->export_country,
            'expired' => $request->expired,
        ]);

        if ($product) {
            return redirect()->route('dashboard.data-products.index')
                ->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('dashboard.data-products.index')
                ->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        if ($product) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $products = DB::table('products')
            ->where('no_po', 'LIKE', "%$keyword%")
            ->orWhere('nama_barang', 'LIKE', "%$keyword%")
            ->get();

        return $products;
    }
}
