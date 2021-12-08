<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aproval;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvalOverProducts = Aproval::with('overProduct')->paginate(10);

        // dd($approvalOverProducts);
        return view('pages.dashboard.pengajuan.index', [
            'aprovalProducts' => $approvalOverProducts
        ]);
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
            'approvals' => 'required',
            'catatan' => 'required'
        ]);

        try {
            //code...
            $length = 6;
            $rand = '';
            for ($i = 0; $i < $length; $i++) {
                $rand .= rand(0, 1) ?
                    rand(0, 9) :
                    chr(rand(ord('a'), ord('z')));
            }
            $aprvCode = 'APRV-' . Str::upper($rand);

            $approvalOverProducts = Aproval::create([
                'users_id'          => auth()->user()->id,
                'over_product_id'   => $request->approvals,
                'kd_pengajuan'      => $aprvCode,
                'kondisi'           => 'not checked',
                'catatan'           => $request->catatan
            ]);
            /*
                many to many (use pivot tale)
                $approvalOverProducts->overProducts()->attach($request->get('approvals'));
            */
            if ($approvalOverProducts) {
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['error' => 'Data Gagal Disimpan']);
            }
        } catch (\Throwable $th) {

            if ($th->getCode() == 23000) {
                // Deal with duplicate key error  
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['error' => 'Kode barang lebih yang sama sudah pernah diajukan']);
            }
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
            'editAproval' => 'required',
            'catatan' => 'required'
        ]);

        try {
            //code...
            $aprovals = Aproval::find($id);
            $aprovals->update([
                'over_product_id' => $request->editAproval,
                'catatan'     => $request->catatan,
            ]);
            // $aprovals->overProducts()->sync($request->get('editApprovals'));
            if ($aprovals) {
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['success' => 'Data Berhasil Diupdate']);
            } else {
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['error' => 'Data Gagal Diupdate']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            if ($th->getCode() == 23000) {
                // Deal with duplicate key error  
                return redirect()->route('dashboard.pengajuan.index')
                    ->with(['error' => 'Kode barang lebih yang sama sudah pernah diajukan']);
            }
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
        $aprovals = Aproval::find($id);
        // $aprovals->overProducts()->detach();
        $aprovals->delete();

        if ($aprovals) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
}