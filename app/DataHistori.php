<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataHistori extends Model
{
    //
    protected $fillable = [
        'keys',
        'value',
        'pengajuan_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
