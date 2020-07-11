<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'state', 'percent'];

    public function lamps() {
        return $this->hasMany('App\Models\Lamp');
    }

    public function is_on()
    {
        return $this->state=='on';
    }

    public function is_off()
    {
        return $this->state=='off';
    }

    public function is_error()
    {
        return $this->state=='error';
    }

    /**
     * Dùng curl gửi dữ liệu đến ESP, với các tên miền được lưu sẵn
     *
     * @return response
     */
    public function sendToESP($level = null)
    {
        if ($level==null) $level = $this->percent;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            // CURLOPT_URL => 'http://'.$this->domain.'/?ledid=0000&level='.sprintf("%02d", $level),
            CURLOPT_URL => 'http://light.techking.vn/ok',
            CURLOPT_USERAGENT => 'Chrome/83.0.4103.116',
            CURLOPT_SSL_VERIFYPEER => false
        ));
        do {
            $resp = curl_exec($curl);
            sleep(1);
        } while ($resp != 'OK');
    }
}
