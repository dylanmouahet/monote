<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $fillable = ['name', 'description', 'type', 'user_id', 'category', 'level'];
}
