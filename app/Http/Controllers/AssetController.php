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
    public function json()
    {
        return DataTables::eloquent(\App\asset::query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route("asset.edit", $query->id) .
                '" class="btn btn-xs btn-warning editor_edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>' .
                    '<a href="' . route("asset.destroy", $query->id) .
                '" class="btn btn-xs btn-danger editor_remove"><i class="glyphicon glyphicon-trash"></i> delete</a>';
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
        \App\asset::find($id)->delete();
        return redirect()->back()
            ->with('success', 'Asset Berhasil Di Hapus');
    }
}
