<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    //
    protected $fillable = [
        'nasabah_id',
        'umur',
        'nilaiPengajuan',
        'perkerjaan',
        'nilaiJaminan',
        'tenorPinjaman',
        'gaji',
        'jaminan',
        'nilaiAsset',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
