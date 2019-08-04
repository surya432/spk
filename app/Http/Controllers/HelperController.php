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
    function numberlimit($hasilOutputZ)
    {
        return number_format((float) $hasilOutputZ, 5, '.', '');
    }
    function sigmoid($t)
    {
        return 1 / (1 + exp(-$t));
    }
    public function hitung($kdPengajuan, $bias)
    {
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $inputx = \App\Setting::where("keys", 'inputanX')->select('value')->first(); //dengan inisial i
        $historiKosong = \App\DataHistori::query();
        $historiKosong->delete();
        $activasi = 0;

        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $Y = 0;
            for ($i = 1; $i <= $inputx->value; $i++) {
                $xw = 0;
                $a = \App\DataTraining::where('keys', 'x' . $i)->first();
                $b = \App\DataTraining::where(['keys' => 'w' . $j . $i, 'pengajuan_id' => $kdPengajuan])->first();
                $xw = ($a['value'] *  $b['value']);
                $Y = $Y + $xw;
                $Y = number_format((float) $Y, 5, '.', '');
                //\App\DataHistori::create(['keys' => 'w' . $i.$j, 'value' => $Y, 'pengajuan_id' => $kdPengajuan]);
            }
            $activasi = $this->sigmoid($Y);
            $activasi = number_format((float) $activasi, 5, '.', '');
            \App\DataHistori::create(['keys' => 'y' . $j, 'value' => $activasi, 'pengajuan_id' => $kdPengajuan]);
            \App\DataHistori::create(['keys' => 'NonSigmoidy' . $j, 'value' => $Y, 'pengajuan_id' => $kdPengajuan]);
            $Y = $activasi;
        }
        return  $this->hitungOutput($kdPengajuan, $bias);
    }
    public function hitungOutput($kdPengajuan, $bias)
    {
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $hasilOutputZ = 0;
        $output = 0;
        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $xw = 0;
            $a = \App\DataTraining::where(['keys' => 'w3' . $j, 'pengajuan_id' => $kdPengajuan])->first();
            $b = \App\DataHistori::where(['keys' => 'y' . $j, 'pengajuan_id' => $kdPengajuan])->first();
            $xw = ($a['value'] * $b['value']); // Z * W
            $xw = number_format((float) $xw, 5, '.', '');
            \App\DataHistori::create(['keys' => 'zw' . $j, 'value' => $xw, 'pengajuan_id' => $kdPengajuan]);
            $output = $output + $xw;
        }
        $hasilOutputZ = $output + $bias; // output + bias
        $hasilOutputZ = number_format((float) $hasilOutputZ, 5, '.', '');

        \App\DataHistori::create(['keys' => 'output', 'value' => $hasilOutputZ, 'pengajuan_id' => $kdPengajuan]);
        \App\DataHistori::create(['keys' => 'outputSigmoid', 'value' => $this->numberlimit($this->sigmoid($hasilOutputZ)), 'pengajuan_id' => $kdPengajuan]);
        $this->errorOutput($kdPengajuan, $bias);
        return $hasilOutputZ;
    }
    public function errorOutput($kdPengajuan, $bias)
    {
        $learningrate = \App\Setting::where("keys", 'learningrate')->select('value')->first(); //learningrate
        $outputSigmoid = \App\DataHistori::where("keys", 'outputSigmoid')->select('value')->first(); //learningrate
        $hasilErrorOutput = $this->numberlimit($outputSigmoid['value'] * ($learningrate['value'] - $outputSigmoid['value']) * ($bias - $outputSigmoid['value']));
        \App\DataHistori::create(['keys' => 'ErrorOutput', 'value' => $hasilErrorOutput, 'pengajuan_id' => $kdPengajuan]);
        return $this->errorY($kdPengajuan, $bias);
    }
    public function errorY($kdPengajuan, $bias)
    {
        $hasilErrorOutput = 0;
        $learningrate = \App\Setting::where("keys", 'learningrate')->select('value')->first(); //learningrate
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $ErrorOutput = \App\DataHistori::where("keys", 'ErrorOutput')->select('value')->first(); //learningrate
        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $sigmoidY = \App\DataHistori::where("keys", 'y' . $j)->select('value')->first(); //learningrate
            $inputLayer = \App\DataTraining::where(['keys' => 'w3' . $j, 'pengajuan_id' => $kdPengajuan])->first();
            //E3 * (B18 - E3) * (E14 - B14)
            $hitungOutput = $sigmoidY['value'] * ($learningrate['value'] - $sigmoidY['value']) * ($ErrorOutput['value'] - $inputLayer['value']);
            $hasilErrorOutput = $this->numberlimit($hitungOutput);
            \App\DataHistori::create(['keys' => 'ErrorOutputY' . $j, 'value' => $hasilErrorOutput, 'pengajuan_id' => $kdPengajuan]);
        }
        return $this->BobotBaruLayer($kdPengajuan, $bias);
    }
    public function BobotBaruLayer($kdPengajuan, $bias)
    {
        $hasilErrorOutput = 0;
        $learningrate = \App\Setting::where("keys", 'learningrate')->select('value')->first(); //learningrate
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $ErrorOutput = \App\DataHistori::where("keys", 'ErrorOutput')->select('value')->first(); //learningrate
        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $hasilErrorOutput = 0;
            $sigmoidY = \App\DataHistori::where("keys", 'y' . $j)->select('value')->first(); //learningrate
            $inputLayer = \App\DataTraining::where(['keys' => 'w3' . $j, 'pengajuan_id' => $kdPengajuan])->first();
            //B14+(B18*E14*E3)
            $hitungOutput = $inputLayer['value'] + ($learningrate['value'] * $ErrorOutput['value'] *  $sigmoidY['value']);
            $hasilErrorOutput = $this->numberlimit($hitungOutput);
            \App\DataTraining::create(['keys' => 'w3' . $j, 'value' => $hasilErrorOutput]);
        }
        return $this->BobotBaruInput($kdPengajuan, $bias);
    }
    public function BobotBaruInput($kdPengajuan, $bias)
    {
        $hasilErrorOutput = 0;
        $learningrate = \App\Setting::where("keys", 'learningrate')->select('value')->first(); //learningrate
        $hiddenLayer = \App\Setting::where("keys", 'hiddenLayer')->select('value')->first(); //dengan inisial J
        $inputx = \App\Setting::where("keys", 'inputanX')->select('value')->first(); //dengan inisial i
        for ($j = 1; $j <= $hiddenLayer->value; $j++) {
            $ErrorOutputY = \App\DataHistori::where(['keys' => 'ErrorOutputY' . $j])->first();
            for ($i = 1; $i <= $inputx->value; $i++) {
                $hitungOutput = 0;
                $bobotX = \App\DataTraining::where('keys', 'x' . $i)->first();
                $bobotW = \App\DataTraining::where(['keys' => 'w' . $j . $i, 'pengajuan_id' => $kdPengajuan])->first();
                //B10+(B18*E19*B1)
                $hitungOutput = $bobotW['value'] + ( ($learningrate['value'] * $ErrorOutputY['value']) * $bobotX['value']);
                $hasilErrorOutput = $this->numberlimit($hitungOutput);
                \App\DataTraining::create(['keys' => 'w' . $j . $i, 'value' => $hasilErrorOutput]);
            }
        }
        return $hasilErrorOutput;
    }
}
