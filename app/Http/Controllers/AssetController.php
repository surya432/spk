<?php

namespace App\Http\Controllers;

use App\asset;
use Illuminate\Http\Request;

use DataTables;
class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json($id)
    {
        return DataTables::of(\App\asset::where('nasabah_id',$id))
            ->addColumn('action', function ($query) {
                return   '<Button data-id="' . $query->id . '" id="btnDeleteAsset" class="btn btn-xs btn-danger editor_remove"><i class="glyphicon glyphicon-trash"></i> delete</Button>';
            })
            ->editColumn('nilaiAsset', function ($self) {
                return "Rp. " . number_format($self->nilaiAsset, 0, '.', '.');
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
    public function create(Request $request)
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
            'namaAsset' => 'required',
            'nilaiAsset' => 'required',
            'nasabah_id' => 'required',
        ]);
        $input = $request->all();
        \App\asset::create($input);
        return redirect()->route('nasabah.show', $request->input("nasabah_id"))
            ->with('success', 'Asset Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'namaAsset' => 'required',
            'nilaiAsset' => 'required',
            'nasabah_id' => 'required',
        ]);
        $data = \App\asset::find($id);
        $data->namaAsset = $request->input("namaAsset");
        $data->nilaiAsset = $request->input("nilaiAsset");
        $data->nasabah_id = $request->input("nasabah_id");
        return redirect()->route('nasabah.show', $request->input("nasabah_id"))
            ->with('success', 'Asset Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $asset = \App\asset::find($id);
        $asset->delete();
        return redirect()->back()
            ->with('success', 'Asset Berhasil Di Hapus');
    }
}
