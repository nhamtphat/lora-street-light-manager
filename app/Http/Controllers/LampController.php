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

    public function getOn($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);
        $street = $lamp->street;
        $street->SendToESP($street->percent, $lamp->uid);

        return redirect()->route('user.street.view.get', ['id'=>$street->id]);
    }
    
    public function getOff($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);
        $street = $lamp->street;
        $street->SendToESP(0, $lamp->uid);
        
        return redirect()->route('user.street.view.get', ['id'=>$street->id]);
    }
}
