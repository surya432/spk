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
    public function getFormattedNilaiPengajuanAttribute()
    {
        return number_format($this->attributes['nilaiPengajuan'], 2);
    }
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function Nasabah()
    {
        return $this->hasOne('App\nasabah', 'id', 'nasabah_id');
    }
}
