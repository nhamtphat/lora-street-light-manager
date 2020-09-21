<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'domain', 'state', 'status', 'level', 'ward_id', 'district_id', 'province_id'];

    public function lamps() {
        return $this->hasMany('App\Models\Lamp');
    }

    public function is_on()
    {
        return $this->status=='on';
    }

    public function is_off()
    {
        return $this->status=='off';
    }

    public function is_error()
    {
        return $this->state=='error';
    }

    public function is_normal()
    {
        return $this->state=='normal';
    }

    public function ward()
    {
        return $this->belongsTo('App\Models\Ward');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function setLevelAttribute($new_level)
    {
        $this->attributes['level'] = $new_level;
        $lamps = $this->lamps;
        foreach ($lamps as $lamp) {
            $lamp->update([
                'level' => $new_level
            ]);
        }
    }

    public function setStatusAttribute($new_status)
    {
        $this->attributes['status'] = $new_status;
        $lamps = $this->lamps;
        foreach ($lamps as $lamp) {
            $lamp->update([
                'status' => $new_status
            ]);
        }
    }
    
    public function SendToESP($level, $ledid=0)
    {

        // SET URL
        if(env('APP_TEST') == true) {
            $curl_url = env('ESP_URL');
        } else {
            $curl_url = 'http://'.$this->domain.'/?ledid='.sprintf("%04d", $ledid).'&level='.sprintf("%02d", $level);
        }

        // CURL INIT
        $curl = curl_init();
        $curl_param = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $curl_url,
            CURLOPT_USERAGENT => 'Chrome/83.0.4103.116',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 10
        );
        curl_setopt_array($curl, $curl_param);

        // LOG FILE INIT, "a" mode is append mode
        $myfile = fopen("esp-log.txt", "a");

        // CURL EXEC, exit if resp is OK
        for ($loop=0; $loop < 5; $loop++) { 
            $resp = curl_exec($curl);

            fwrite($myfile, date('H:i:s').' ==> '.$curl_url.' ==> '.$resp."\n");
            if ($resp == 'OK') break;
            sleep(1);
        }

        // If resp isn't OK, set state to error
        if ($resp != 'OK' && $resp != 'Busy') {
            $this->state = 'error';
            $this->save();
            $resp = 'error';
        }

        fclose($myfile);

        return $resp;
    }

    public function autoUpdateStatus()
    {
        $lamps = $this->lamps;
        
        // if all lamps are on
        if($lamps->where('status', 'on')->count() == $lamps->count()) {
            $this->update(['status' => 'on']);
        }
        
        // if all lamps are off
        elseif($lamps->where('status', 'off')->count() == $lamps->count()) {
            $this->update(['status' => 'off']);
        }
        
    }

    public function turnOn()
    {
        // Điều khiển ESP
        $esp_result = $this->SendToESP($this->level);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $result = [
                'state' => $this->state,
                'status' => 'on',
                'msg'=> 'Đã bật tuyến '.$this->name.'.'
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $result = [
                'state'=> 'error', 
                'status' => $this->status,
                'msg'=>'Không thể kết nối tuyến '.$this->name.'.'
            ];
        }

        // Cập nhật CSDL
        $this->update($result);
    }

    public function turnOff()
    {
        // Điều khiển ESP
        $esp_result = $this->SendToESP(0);

        // Nếu thành công, state giữ nguyên, trả kết quả status mới
        if ($esp_result=='OK') {
            $result = [
                'state' => $this->state,
                'status' => 'off',
                'msg'=> 'Đã tắt tuyến '.$this->name.'.'
            ];
        } 

        // Nếu thất bại, trả về state là 'error', status giữ nguyên
        elseif ($esp_result == 'error') {
            $result = [
                'state'=> 'error', 
                'status' => $this->status,
                'msg'=>'Không thể kết nối tuyến '.$this->name.'.'
            ];
        }
        
        // Cập nhật CSDL
        $this->update($result);
    }
}
