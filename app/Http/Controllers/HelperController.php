<?php

namespace App\Http\Controllers;

use phpDocumentor\Reflection\Types\Array_;

trait HelperController
{
    // x3 = umur, x2 = gaji, x1 = nilai jaminan, x4 = nilai milik sendiri 
    public function variabelX3($umur, $batasUmur)
    {
        return $umur >= $batasUmur ? 1 : 0;
    }

    public function variabelX4($pengajuan, $sisaAsset)
    {
        return $pengajuan >= $sisaAsset ? 1 : 0;
    }
    public function variabelX2($nilaiPinjaman, $bunggaKPR, $tenor, $batasMinimTungakkan, $gajiBersih)
    {

        $dataA = ($nilaiPinjaman * $bunggaKPR / 100) + ($nilaiPinjaman /  $tenor) * $batasMinimTungakkan;
        $dataB = $gajiBersih / $batasMinimTungakkan;
        return $dataA > $dataB ? 1 : 0;
    }

    public function variableX1($nilaiPinjaman, $nilaiJaminan)
    {
        $dataA =  $nilaiJaminan / 2;

        if ($nilaiPinjaman < $dataA) {
            $nilaiCoverages = $this->nilaiCoverage($nilaiJaminan, $nilaiPinjaman);
            return $nilaiCoverages;
        } else {
            return 0;
        }
    }

    public function nilaiCoverage($nilaiJaminan, $nilaiPinjaman)
    {
        $dataA =  $nilaiPinjaman / $nilaiJaminan * 100;
        return $dataA;
    }
    public function convertTo($nilaiJaminan, $nilaiPinjaman)
    {
        $dataA =  $nilaiPinjaman / $nilaiJaminan * 100;
        return $dataA;
    }
    public function hitung($kdPengajuan,$bias){
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $inputx = \App\Setting::where("keys", 'inputanX')->select('value')->first(); //dengan inisial i
        $y = 0;
        for($j = 1; $j <= $hiddenLayer->value ;$j++){
            $activasi = 0;
            (float) $Y = 0;
            for($i= 1;$i <= $inputx->value ; $i++){
                $a = \App\DataTraining::where('keys', 'x' . $i)->first();
                $b = \App\DataTraining::where(['keys'=>'w' . $i . $j, 'pengajuan_id'=>$kdPengajuan])->first();
                $xw = (float)$a['value'] * (float)$b['value'];
                 $Y = $Y + $xw;
               // \App\DataHistori::create(['keys' => 'w' . $i, 'value' => $xw, 'pengajuan_id' => $kdPengajuan]);
            }
            $activasi = $this->sigmoid($Y * $bias);
            \App\DataHistori::create(['keys' => 'y' . $j, 'value' => $activasi, 'pengajuan_id' => $kdPengajuan]);

        }
        return $this->hitungOutput($kdPengajuan, $bias);
    }
    public function hitungOutput($kdPengajuan, $bias)
    {
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $inputx = \App\Setting::where("keys", 'inputanX')->select('value')->first(); //dengan inisial i
        $Y = 0;
        $data = $hiddenLayer->value * $inputx->value;
        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $xw = 0;
            for ($i = 1; $i <= $inputx->value; $i++) {
                $a = \App\DataTraining::where('keys', 'x' . $i)->first();
                $b = \App\DataTraining::where(['keys' => 'w' . $i . $j, 'pengajuan_id' => $kdPengajuan])->first();
                $xw = $a['value'] * $b['value'];
       //         \App\DataHistori::create(['keys' => 'w' . $i, 'value' => str_replace($xw, ',', '.'), 'pengajuan_id' => $kdPengajuan]);
            }
            $Y = $Y + $xw;
        }
        \App\DataHistori::create(['keys' => 'output', 'value' => str_replace($Y, ',', '.'), 'pengajuan_id' => $kdPengajuan]);
        return $Y;
    }
    function sigmoid($t)
    {
        return 1 / (1 + exp(-$t));
    }
}
