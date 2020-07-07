<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $fillable = ['name', 'time', 'state', 'percent'];
    public $timestamps = false;
}
