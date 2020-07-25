<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Street;
use App\Models\Lamp;
use App\Models\Schedule;

// use App\Providers\StreetControl;

class StreetControl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'street:control';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schedule = Schedule::whereTime('time', '>=', date("H:i:00"))->whereTime('time', '<=', date("H:i:59"))->first();
        if(!isset($schedule)) return;
        $streets = Street::all();
        echo $schedule->state.' - '.$schedule->percent;
            foreach ($streets as $street) {
                $street->update(['state' => $schedule->state, 'percent' => $schedule->percent]);
                $level = ($schedule->state == 'off')? 0 : $schedule->percent;
                $resp = $street->SendToESP($level);
            }
    }
}
