<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class HistoriTrainingController extends Controller
{
    //
    public function index()
    {
        return view('training.index');
    }
    public function jsonOutput($id)
    {
        $data = \App\DataHistori::where('pengajuan_id', $id)->get();

        return DataTables::of($data)
            ->rawColumns(['keys', 'value'])
            ->make(true);
    }
    public function jsonInput($id)
    {
        $data = \App\DataTraining::where('pengajuan_id', $id)->get();

        return DataTables::of($data)
            ->rawColumns(['keys', 'value'])
            ->make(true);
    }
    public function json()
    {
        $data = \App\pengajuan::whereIn('id', function ($query) {
            $query->select('pengajuan_id')->from('data_trainings')->whereNotNull('pengajuan_id')->groupBy('pengajuan_id')->get();
        })->with('nasabah')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($query) {
                return
                '<a href="historitraining/' . $query->id . '" data-id="' . $query->id . '" id="btnTrainingPengajuan" class="btn btn-xs btn-warning editor_proses"><i class="glyphicon glyphicon-edit"></i> Training</a>';
            })
            ->editColumn('nilaiPengajuan', function ($self) {
                return "Rp. " . number_format($self->nilaiPengajuan, 0, '.', '.');
            })
            

            ->rawColumns(['nama', 'action'])
            ->make(true);
    }
    public function show($id)
    {
        //
       
        $data = \App\pengajuan::where('id', $id)->with('Nasabah')->first();
        $nasabah = \App\nasabah::where('id', $data->nasabah_id)->first();
        return view('training.histori', compact('data', 'nasabah'));
    }
}
