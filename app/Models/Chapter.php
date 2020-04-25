<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'learning_id'];
}
