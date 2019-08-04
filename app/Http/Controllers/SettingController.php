<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use HelperController;
    public function json()
    {
        return DataTables::of(\App\Setting::all())
            ->addColumn('action', function ($query) {
                return '<Button data-id="' . $query->id . '" data-keys="' . $query->keys . '" data-value="' . $query->value . '" id="btnEditSetting" class="btn btn-xs btn-warning editor_remove"><i class="glyphicon glyphicon-edit"></i> Edit</Button>'.'<Button data-id="' . $query->id . '" id="btnDeleteSetting" class="btn btn-xs btn-danger editor_remove"><i class="glyphicon glyphicon-trash"></i> Delete</Button>';

            })

            ->rawColumns(['nama', 'action'])
            ->make(true);
    }
    public function index()
    {
        //
       dd($this->hitung(1, 0.25)) ;
        return view('setting.index');
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
            'keys' => 'required',
            'value' => 'required',
           
        ]);
        if(!empty($request->input('id'))){
            $data = \App\Setting::find($request->input('id'));
            $data->keys = $request->input('keys');
            $data->value = $request->input('value');
            $data->save();
        }else{
            \App\Setting::create($request->all());

        }
        return redirect()->route('setting.index')
            ->with('success', 'Setting Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
        $this->validate($request, [
            'keys' => 'required',
            'value' => 'required',
            'id' => 'required',
        ]);
        $data = \App\Setting::find($request->input('id'));
        $data->keys = $request->input('keys');
        $data->value = $request->input('value');
        $data->save();
        return redirect()->route('setting.index')
            ->with('success', 'Setting Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        \App\Setting::find($id)->delete();
        return redirect()->route('setting.index')
            ->with('success', 'Setting Berhasil Di Simpan');
    }
}
