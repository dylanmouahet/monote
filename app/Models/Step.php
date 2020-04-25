<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'project_id'];
}
