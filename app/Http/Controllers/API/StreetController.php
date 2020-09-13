<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Street;
use App\Models\Lamp;

class StreetController extends Controller
{

    /**
     * Bật tất cả đèn của tuyến đường
     *
     * @return json
     */
    public function setOn($street_id)
    {
        $street = Street::findOrFail($street_id);
        
        // Điều khiển ESP
        $esp_result = $street->SendToESP($street->level);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $result = [
                'state' => $street->state,
                'status' => 'on',
                'msg'=> 'Đã bật tuyến '.$street->name.'.'
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $result = [
                'state'=> 'error', 
                'status' => $street->status,
                'msg'=>'Không thể kết nối tuyến '.$street->name.'.'
            ];
        }

        // Cập nhật CSDL
        $street->update($result);
        return $street;
    }

    /**
     * Tắt tất cả đèn của tuyến đường
     *
     * @return json
     */
    public function setOff($street_id)
    {
        $street = Street::findOrFail($street_id);
        
        // Điều khiển ESP
        $esp_result = $street->SendToESP(0);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $result = [
                'state' => $street->state,
                'status' => 'off',
                'msg'=> 'Đã tắt tuyến '.$street->name.'.'
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $result = [
                'state'=> 'error', 
                'status' => $street->status,
                'msg'=>'Không thể kết nối tuyến '.$street->name.'.'
            ];
        }
        
        // Cập nhật CSDL
        $street->update($result);
        return $street;
    }
    

    /**
     * Điều chỉnh độ sáng của tuyến đường
     *
     * @return json
     */
    public function setLevel($street_id, $level)
    {
        $street = Street::findOrFail($street_id);
        $street->update(['level' => $level]);

        // Nếu đèn đang tắt, chỉ cần cập nhật CSDL
        if ($street->status == 'off') return $street;

        // Nếu đèn đang bật, thực hiện api bật đèn
        return $this->setOn($street_id);
    }

    /**
     * Kiểm tra các đèn bị lỗi
     *
     * @return json
     */
    public function getListOfErrorLamps()
    {
        $lamps_id = Lamp::where('state', 'error')->get()->pluck('id');
        return $lamps_id;
    }
}
