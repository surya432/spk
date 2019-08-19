<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Charts\SimpleChart;

class HistoriTrainingController extends Controller
{
    //
    public function index()
    {
        $Labels = \App\DataHistori::select('pengajuan_id')->groupBy('pengajuan_id')->get();
        $data = array(); // Could also be an array
        $labal = array(); // Could also be an array
        foreach($Labels as $a=>$b){
            $namaNasabah = \App\pengajuan::where('pengajuans.id',$b['pengajuan_id'])
                ->join('nasabahs', 'nasabahs.id', '=', 'pengajuans.nasabah_id')
                ->select('nasabahs.nama')->first();
            array_push($labal, $namaNasabah['nama']);
        }
        foreach ($Labels as $a => $b) {           
            $output = \App\DataHistori::where("keys", 'output')->where('pengajuan_id', $b['pengajuan_id'])->select('value')->first();
            array_push($data, $output['value']); 
        }
       //dd($data);
        $chart = new SimpleChart;
        $chart->labels($labal);
        $chart->dataset('My dataset', 'line',$data);
        return view('histori.index', compact('chart'));
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
        })->with('nasabah')->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($query) {
                return
                '<a href="historitraining/' . $query->id . '" data-id="' . $query->id . '" id="btnTrainingPengajuan" class="btn btn-xs btn-primary editor_proses"><i class="glyphicon glyphicon-edit"></i> Hasil Training</a>';
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
        return view('histori.histori', compact('data', 'nasabah'));
    }
}
