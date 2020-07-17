<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('schedules')->delete();
        
        \DB::table('schedules')->insert(array (
            0 => 
            array (
                'id' => 5,
                'name' => 'a',
                'time' => '21:36:00',
                'state' => 'off',
                'percent' => 0,
            ),
        ));
        
        
    }
}