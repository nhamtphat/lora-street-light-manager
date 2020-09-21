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
        $street->turnOn();
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
        $street->turnOff();
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
