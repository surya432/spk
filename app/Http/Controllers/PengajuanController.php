<?php

namespace App\Http\Controllers;

use App\pengajuan;
use Illuminate\Http\Request;
use DataTables;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json($id)
    {
        return DataTables::of(\App\pengajuan::where('nasabah_id',$id)->get())
            ->addColumn('action', function ($query) {
                return
                    '<Button data-id="'.$query->id. '" id="btnDeletePengajuan" class="btn btn-xs btn-danger editor_remove"><i class="glyphicon glyphicon-trash"></i> delete</Button>';
            })
            ->editColumn('nilaiPengajuan', function ($self) {
                return "Rp. " . number_format($self->nilaiPengajuan, 0, '.', '.');
            })
            ->rawColumns(['nama', 'action'])
            ->make(true);
    }
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
        $this->validate($request, [
            'nasabah_id' => 'required',
            'umur' => 'required',
            'nilaiPengajuan' => 'required',
            'perkerjaan' => 'required',
            'nilaiJaminan' => 'required',
            'tenorPinjaman' => 'required',
            'gaji' => 'required',
            'jaminan' => 'required',
            'nilaiAsset' => 'required',
        ]);
        $input = $request->all();
        $temp =[
            "nasabah_id" => $request->input('nasabah_id'),
            "umur" => $request->input('umur'),
            "perkerjaan" => $request->input('perkerjaan'),
            "tenorPinjaman" => $request->input('tenorPinjaman'),
            "nilaiPengajuan" => str_replace(".", "", $request->input('nilaiPengajuan')),
            "gaji" => str_replace(".", "", $request->input('gaji')),
            "jaminan" => str_replace(".", "", $request->input('jaminan')),
            "nilaiAsset" => str_replace(".", "", $request->input('nilaiAsset')),
            "nilaiJaminan" => str_replace(".", "", $request->input('nilaiJaminan')),
        ];
        \App\pengajuan::create($temp);
        return redirect()->route('nasabah.show',$request->input('nasabah_id'))
            ->with('success', 'Pengajuan Berhasil Di Simpan');
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
        $data = \App\nasabah::where('id',$id)->first();
        $from = new \DateTime($data->tanggalLahir);
        $to   = new \DateTime('today');
        $data['yearOld'] = $from->diff($to)->y;
        $data['asset'] = \App\asset::where('nasabah_id', $data->id)->get();
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
    public function destroy($id)
    {
        //
        $pengajuan = \App\pengajuan::find($id);
        $pengajuan->delete();
        return redirect()->route('nasabah.index')
            ->with('success', 'Pengajuan Berhasil Di Hapus');
    }
}
