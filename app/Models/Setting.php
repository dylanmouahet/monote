<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['user_id', 'notification', 'newsletter'];
}
