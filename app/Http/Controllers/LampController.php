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
    
    public function getReset($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);
        $data = [
            'state' => 'normal',
            'status' => 'off'
        ];
        $lamp->update($data);
        return redirect()->route('user.street.view.get', ['id'=>$lamp->street->id]);
    }

    public function turnOn($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);

        // Điều khiển ESP
        $street = $lamp->street;
        $esp_result = $street->SendToESP($street->percent, $lamp->uid);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $data = [
                'status' => 'on',
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $data = [
                'state'=> 'error', 
            ];
        }

        // Cập nhật CSDL
        $lamp->update($data);
        $lamp->street->autoUpdateStatus();
        return redirect()->route('user.street.view.get', ['id'=>$street->id]);
    }
    
    public function turnOff($lamp_id)
    {
        $lamp = Lamp::findOrFail($lamp_id);

        // Điều khiển ESP
        $street = $lamp->street;
        $esp_result = $street->SendToESP(0, $lamp->uid);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $data = [
                'status' => 'off',
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $data = [
                'state'=> 'error', 
            ];
        }

        // Cập nhật CSDL
        $lamp->update($data);
        $lamp->street->autoUpdateStatus(); 
        return redirect()->route('user.street.view.get', ['id'=>$street->id]);
    }
}
