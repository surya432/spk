<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    //
    protected $fillable = [
        'keys',
        'value'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
