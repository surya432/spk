<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PHPUnit\Framework\Constraint\IsEmpty;

class DataTrainingController extends Controller
{
    //

    use HelperController;
    public function index()
    {
        
        return view('training.index');
    }
    public function json()
    {
        $data = \App\pengajuan::whereNotIn('id', function ($query) {
            $query->select('pengajuan_id')->from('data_trainings')->whereNotNull('pengajuan_id')->groupBy('pengajuan_id')->get();
        })->with('nasabah')->orderBy('created_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($query) {
                return
                    '<a href="datatraining/' . $query->id . '" data-id="' . $query->id . '" id="btnTrainingPengajuan" class="btn btn-xs btn-warning editor_proses"><i class="glyphicon glyphicon-edit"></i> Training</a>';
            })
            ->editColumn('nilaiPengajuan', function ($self) {
                return "Rp. " . number_format($self->nilaiPengajuan, 0, '.', '.');
            })

            ->rawColumns(['nama', 'action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $countDataHistory = \App\DataTraining::all()->count();

        $pengajuan_id = $request->input('pengajuan_id');
        if ($countDataHistory < 1) {
            $dataY = str_replace(',', '.', $request->input('w'));
            foreach ($dataY as $ya) {
                $y = explode(":::", $ya);
                $temp = [
                    'keys' => $y[0],
                    'value' => $y[1],
                    'pengajuan_id' =>  $pengajuan_id
                ];
                \App\DataTraining::create($temp);
            }
            $dataZ = str_replace(',', '.', $request->input('z'));
            foreach ($dataZ as  $za) {
                $z = explode(":::", $za);
                $temp = [
                    'keys' => $z[0],
                    'value' => $z[1],
                    'pengajuan_id' =>  $pengajuan_id,
                ];
                \App\DataTraining::create($temp);
            }
        } else {
            \App\DataTraining::whereNull('pengajuan_id')->update([
                'pengajuan_id' => $pengajuan_id,
            ]);
        }

        $temp = [
            'keys' => 'bias',
            'value' => str_replace(',', '.', $request->input('bias')),
            'pengajuan_id' =>  $pengajuan_id,
        ];
        \App\DataTraining::create($temp);
        $dataX = str_replace(',', '.', $request->input('x'));
        foreach ($dataX as $x) {
            $x = explode(":::", $x);
            $temp = [
                'keys' => $x[0],
                'value' => $x[1],
                'pengajuan_id' =>  $pengajuan_id
            ];
            \App\DataTraining::create($temp);
        }
        $this->hitung($request->input('pengajuan_id'));
        return redirect()->route('datatraining.index')
            ->with('success', 'Data Training Berhasil');
    }
    public function show($id)
    {
        //
        $inputanX = \App\Setting::where('keys', 'inputanX')->first();
        $hiddenLayer = \App\Setting::where('keys', 'hiddenLayer')->first();
        $learningrate = \App\Setting::where('keys', 'learningrate')->first();
        $data = \App\pengajuan::where('id', $id)->with('Nasabah')->first();
        $nasabah = \App\nasabah::where('id', $data->nasabah_id)->first();
        $from = new \DateTime($nasabah->tanggalLahir);
        $to   = new \DateTime('today');
        $data['umur'] = $from->diff($to)->y;
        $data['inputanX'] = $inputanX->value;
        $data['bobotLayers'] = $hiddenLayer->value;
        $data['learningrate'] = $inputanX->value;
        $data['BobotNeuron'] = $inputanX->value * $hiddenLayer->value;
        $data['datatraining'] = \App\DataTraining::all()->count();
        $data['x1'] = $this->variabelX1($data->nilaiPengajuan, $data->nilaiAsset);
        $data['x2'] = $this->variabelX2($data->nilaiPengajuan, '2', $data->tenorPinjaman, "2", $data->gaji);
        $data['x3'] = $this->variabelX3($data->umur, 50);
        $data['x4'] = $this->variabelX3($data->nilaiPengajuan, $data->nilaiAsset);

        return view('training.show', compact('data', 'nasabah'));
    }
}
