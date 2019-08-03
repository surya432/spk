<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
    //
    protected $fillable = [
        'namaAsset',
        'nilaiAsset',
        'nasabah_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
