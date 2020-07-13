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
     * Dùng curl gửi dữ liệu đến ESP, với các tên miền được lưu sẵn
     *
     * @param  StreetControled  $event
     * @return void
     */
    public function handle(StreetControled $event)
    {
    }
}
