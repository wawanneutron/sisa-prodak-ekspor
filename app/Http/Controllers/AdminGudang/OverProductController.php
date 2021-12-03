<?php

namespace App\Http\Controllers\AdminGudang;

use App\Http\Controllers\Controller;
use App\Models\OverProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OverProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overProducts = OverProduct::paginate(10);

        return view('pages.admin-gudang.over.index', compact('overProducts'));
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
            'qty_over' => 'required',
            'kondisi' => 'required',
            'listProducts' => 'required',
            'note' => 'required'
        ]);

        $length = 7;
        $rand = '';
        for ($i = 0; $i < $length; $i++) {
            $rand .= rand(0, 1) ?
                rand(0, 9) :
                chr(rand(ord('a'), ord('z')));
        }
        $overCode = 'OVER-' . Str::upper($rand);

        $overProducts = OverProduct::create([
            'users_id' => auth()->user()->id,
            'over_product_id' => $overCode,
            'qty_over' => $request->qty_over,
            'kondisi' => $request->kondisi,
            'note'     => $request->note
        ]);

        $overProducts->products()->attach($request->get('listProducts'));


        if ($overProducts) {
            return redirect()->route('dashboard.over-products.index')
                ->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('dashboard.over-products.index')
                ->with(['success' => 'Data Gagal Disimpan']);
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
        $this->validate($request, [
            'qty_over' => 'required',
            'kondisi' => 'required',
            'listEditProducts' => 'required',
            'note' => 'required'
        ]);

        $overProducts = OverProduct::find($id);

        $overProducts->update([
            'note'     => $request->note,
            'qty_over' => $request->qty_over,
            'kondisi' => $request->kondisi,
            'note' => $request->note
        ]);


        $overProducts->products()->sync($request->get('listEditProducts'));


        if ($overProducts) {
            return redirect()->route('dashboard.over-products.index')
                ->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('dashboard.over-products.index')
                ->with(['error' => 'Data Gagal Disimpan']);
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
        $overProducts = OverProduct::find($id);
        $overProducts->products()->detach();
        $overProducts->delete();

        if ($overProducts) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function ajaxSearchOver()
    {
        $overProducts = DB::table('over_products')
            ->where('over_product_id', 'like', '%' . request()->q . '%')
            ->orWhere('kondisi', 'like', '%' . request()->q . '%')
            ->get();

        return $overProducts;
    }
}
