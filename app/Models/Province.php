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
        $lamps_is_on = $this->lamps->where('status', 'on');
        return $lamps_is_on;
    }

    public function listOfLampsIsOff()
    {
        $lamps_is_off = $this->lamps->where('status', 'off');
        return $lamps_is_off;
    }

    public function turnOn()
    {
        $streets = $this->streets;
        foreach ($streets as $street) {
            $street->turnOn();
        }

        return redirect()->route('user.provinces.list');
    }

    public function turnOff()
    {
        $streets = $this->streets;
        foreach ($streets as $street) {
            $street->turnOff();
        }

        return redirect()->route('user.provinces.list');
    }
}
