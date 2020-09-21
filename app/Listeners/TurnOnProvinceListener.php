<?php

namespace App\Listeners;

use App\Events\TurnOnProvinceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TurnOnProvinceListener implements ShouldQueue
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
     * @param  TurnOnProvinceEvent  $event
     * @return void
     */
    public function handle(TurnOnProvinceEvent $event)
    {
        $streets = $event->province->streets->where('status', 'off');
        foreach ($streets as $street) {
            $street->turnOn();
        }
    }
}
