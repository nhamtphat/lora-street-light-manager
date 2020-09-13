<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps=false;
    public $table="provinces";

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }

    public function streets()
    {
        return $this->hasMany('App\Models\Street');
    }

    public function lamps()
    {
        return $this->hasManyThrough('App\Models\Lamp', 'App\Models\Street');
    }

    public function listOfLampsIsOn()
    {
        $lamps_is_on = $this->lamps->filter(function ($lamp)
        {
            return $lamp->status == 'on';
        });

        return $lamps_is_on;
    }

    public function listOfLampsIsOff()
    {
        $lamps_is_off = $this->lamps->filter(function ($lamp)
        {
            return $lamp->status == 'off';
        });

        return $lamps_is_off;
    }
}
