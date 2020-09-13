<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps=false;
    protected $table="districts";

    public function wards()
    {
        return $this->hasMany('App\Models\Ward');
    }
    
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
