<?php

namespace App\Listeners;

use App\Events\BrightnessChangeProvinceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrightnessChangeProvinceListener
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
     * @param  BrightnessChangeProvinceEvent  $event
     * @return void
     */
    public function handle(BrightnessChangeProvinceEvent $event)
    {
        $streets = $event->province->streets->where('state', 'normal');
        foreach ($streets as $street) {
            $street->update(['level' => $event->level]);
            $street->turnOn();
        }
    }
}
