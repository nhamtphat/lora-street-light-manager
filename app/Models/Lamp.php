<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamp extends Model
{
    public $timestamps = false;
    public $fillable = ['uid', 'street_id', 'state', 'status'];

    public function street()
    {
        return $this->belongsTo('App\Models\Street');
    }

    public function is_on()
    {
        return $this->status=='on';
    }

    public function is_off()
    {
        return $this->status=='off';
    }

    public function is_error()
    {
        return $this->state=='error';
    }

    public function is_normal()
    {
        return $this->state=='normal';
    }
}
