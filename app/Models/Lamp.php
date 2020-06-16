<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamp extends Model
{
    public $timestamps = false;
    public $fillable = ['uid', 'street_id'];

    public function street()
    {
        return $this->belongsTo('App\Models\Street');
    }
    public function is_error()
    {
        return ($this->state == 'error');
    }
    public function is_on()
    {
        return ($this->state == 'on');
    }
}
