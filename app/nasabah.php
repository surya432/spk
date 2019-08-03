<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nasabah extends Model
{
    //
    protected $fillable = [
        'nama',
        'status',
        'alamat',
        'istriSuami',
        'pekerjaan',
        'telp',
        'tanggalLahir',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function assetNasabah()
    {
        return $this->hasMany('App\asset', 'nasabah_id', 'id');
    }
    public function pengajuanNasabah()
    {
        return $this->hasMany('App\pengajuan', 'nasabah_id', 'id');
    }
}
