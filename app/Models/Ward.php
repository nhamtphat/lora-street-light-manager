<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps=false;
    protected $table="wards";

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
}
