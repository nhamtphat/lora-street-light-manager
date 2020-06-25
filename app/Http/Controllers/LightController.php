<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LightController extends Controller
{
    public function getReport($light_id)
    {
        
        return ["led_id" => $light_id, "status" => "OK"];
    }
}
