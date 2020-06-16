<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'state', 'percent'];

    public function lamps() {
        return $this->hasMany('App\Models\Lamp');
    }

    public function is_on()
    {
        return $this->state=='on';
    }

    public function is_off()
    {
        return $this->state=='off';
    }

    public function is_error()
    {
        return $this->state=='error';
    }
}
