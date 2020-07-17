<?php

use Illuminate\Database\Seeder;

class LampsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lamps')->delete();
        
        \DB::table('lamps')->insert(array (
            0 => 
            array (
                'id' => 16,
                'uid' => 1,
                'street_id' => 4,
                'status' => 'normal',
            ),
            1 => 
            array (
                'id' => 17,
                'uid' => 2,
                'street_id' => 4,
                'status' => 'normal',
            ),
            2 => 
            array (
                'id' => 18,
                'uid' => 3,
                'street_id' => 4,
                'status' => 'error',
            ),
            3 => 
            array (
                'id' => 19,
                'uid' => 4,
                'street_id' => 10,
                'status' => 'normal',
            ),
            4 => 
            array (
                'id' => 20,
                'uid' => 5,
                'street_id' => 10,
                'status' => 'normal',
            ),
            5 => 
            array (
                'id' => 21,
                'uid' => 6,
                'street_id' => 10,
                'status' => 'error',
            ),
        ));
        
        
    }
}