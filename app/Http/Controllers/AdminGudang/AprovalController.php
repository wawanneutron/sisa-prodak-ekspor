<?php

namespace App\Http\Controllers\AdminGudang;

use App\Http\Controllers\Controller;
use App\Models\Aproval;
use App\Models\OverProduct;
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
        $approvalOverProducts = Aproval::paginate(10);

        return view('pages.admin-gudang.pengajuan.index', [
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
            'kd_pengajuan'      => $aprvCode,
            'kondisi'           => 'not checked',
            'catatan'           => $request->catatan
        ]);

        $approvalOverProducts->overProducts()->attach($request->get('approvals'));


        if ($approvalOverProducts) {
            return redirect()->route('dashboard.pengajuan.index')
                ->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('dashboard.pengajuan.index')
                ->with(['error' => 'Data Gagal Disimpan']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
