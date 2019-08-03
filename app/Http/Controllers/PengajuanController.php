<?php

namespace App\Http\Controllers;

use App\pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $data = \App\nasabah::find($id)->with('assetNasabah')->first();
        $from = new \DateTime($data->tanggalLahir);
        $to   = new \DateTime('today');
        $data['yearOld'] = $from->diff($to)->y;
        $data['asset'] = \App\asset::where('nasabah_id', $data->id)->get();
        $data['nilaiAsset'] = str_replace(',','.', \App\asset::where('nasabah_id', $data->id)->sum('nilaiAsset'));
        return view('pengajuan.show',compact('data'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengajuan $pengajuan)
    {
        //
    }
}
