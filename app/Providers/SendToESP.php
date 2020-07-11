<?php

namespace App\Providers;

use App\Providers\StreetControled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendToESP implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StreetControled  $event
     * @return void
     */
    public function handle(StreetControled $event)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$event->street->domain.'/?ledid=0000&level='.sprintf("%02d", $event->level),
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
