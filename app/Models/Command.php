<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule', 'type', 'type_id');
    }
}
