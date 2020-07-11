<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamp;

class LampController extends Controller
{
    public function getReport($lamp_uid)
    {
        $lamp = Lamp::where('uid', $lamp_uid)->firstOrFail();
        $lamp->status = 'error';
        $lamp->save();
        return ["led_id" => $lamp_uid, "status" => "OK"];
    }

    public function getRefresh($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);
        $lamp->status = 'normal';
        $lamp->save();
        return redirect()->route('user.street.view.get', ['id'=>$lamp->street->id]);
    }
}
