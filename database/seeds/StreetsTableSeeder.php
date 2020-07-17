<?php

use Illuminate\Database\Seeder;

class StreetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('streets')->delete();
        
        \DB::table('streets')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'Dãy A',
                'domain' => 'street1.themvn.icu:2020',
                'state' => 'on',
                'percent' => '10',
            ),
            1 => 
            array (
                'id' => 10,
                'name' => 'Dãy B',
                'domain' => 'street1.themvn.icu:2021',
                'state' => 'on',
                'percent' => '2',
            ),
        ));
        
        
    }
}