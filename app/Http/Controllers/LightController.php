<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamp;

class LightController extends Controller
{
    public function getReport($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);
        $lamp->street->state = 'error';
        $lamp->street->save();
        return ["led_id" => $lamp_id, "status" => "OK"];
    }
}
