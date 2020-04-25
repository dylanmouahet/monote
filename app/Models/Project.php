<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'deadline' => 'datetime',
    ];
}
