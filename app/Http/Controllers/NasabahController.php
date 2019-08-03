<?php

namespace App\Http\Controllers;

use App\nasabah;
use Illuminate\Http\Request;
use DataTables;
class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        return DataTables::eloquent(\App\nasabah::query())
            ->addColumn('action', function ($query) {
                return '<a href="' . route("nasabah.edit", $query->id) .
                    '" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                '<a href="' . route("nasabah.show", $query->id) .
                '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Show</a>'.
                '<Button data-id="'. $query->id. '" id="btnDelete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> delete</Button>';
            })
            ->rawColumns(['nama', 'action'])
            ->make(true);
    }
    public function index()
    {
        //
        return view('nasabah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nasabah.create');
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
            'nama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'tanggalLahir' => 'required',
        ]);
        $input = $request->all();
        \App\nasabah::create($input);
        return redirect()->route('nasabah.index')
            ->with('success', 'Nasabah Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = \App\nasabah::find($id);
        return view('nasabah.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data =\App\nasabah::find($id);
        return view('nasabah.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'nama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'tanggalLahir' => 'required',
        ]);
        $data = \App\nasabah::find($id);
        $data->nama = $request->input('nama');
        $data->status = $request->input('status');
        $data->pekerjaan = $request->input('pekerjaan');
        $data->telp = $request->input('telp');
        $data->alamat = $request->input('alamat');
        $data->tanggalLahir = $request->input('tanggalLahir');
        $data->istriSuami = $request->input('istriSuami');
        $data->save();
        return redirect()->route('nasabah.index')
            ->with('success', 'Nasabah Berhasil Di Edit');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       \App\nasabah::find($id)->delete();
        return redirect()->route('nasabah.index')
            ->with('success', 'Nasabah Berhasil Di Hapus');
    }
}
