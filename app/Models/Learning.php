<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
