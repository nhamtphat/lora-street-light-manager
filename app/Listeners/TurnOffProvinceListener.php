<?php

namespace App\Listeners;

use App\Events\TurnOffProvinceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TurnOffProvinceListener implements ShouldQueue
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
     * @param  TurnOffProvinceEvent  $event
     * @return void
     */
    public function handle(TurnOffProvinceEvent $event)
    {
        $streets = $event->province->streets->where('status', 'on');
        foreach ($streets as $street) {
            $street->turnOff();
        }
    }
}
