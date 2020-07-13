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
    
    public function SendToESP($level = NULL)
    {
        if ($level == NULL) $level = $this->percent;
        $ledid = 0;

        // SET URL
        $curl_url = 'http://'.$this->domain.'/?ledid='.sprintf("%04d", $ledid).'&level='.sprintf("%02d", $level);
        // $curl_url = 'http://light.techking.vn/ok';

        // CURL INIT
        $curl = curl_init();
        $curl_param = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $curl_url,
            CURLOPT_USERAGENT => 'Chrome/83.0.4103.116',
            CURLOPT_SSL_VERIFYPEER => false
        );
        curl_setopt_array($curl, $curl_param);

        // LOG FILE INIT, "a" mode is append mode
        $myfile = fopen("esp-log.txt", "a") or die("Unable to open file!");

        // CURL EXEC, exit if resp is OK
        for ($loop=0; $loop < 3; $loop++) { 
            $resp = curl_exec($curl);
            fwrite($myfile, date('H:i:s').' ==> '.$curl_url.' ==> '.$resp."\n");
            if ($resp == 'OK') break;
        }

        // If resp isn't OK, set state to error
        if ($resp != 'OK') {
            $this->state = 'error';
            $this->save();
            $resp = 'error';
        }

        fclose($myfile);

        return $resp;
    }
}
