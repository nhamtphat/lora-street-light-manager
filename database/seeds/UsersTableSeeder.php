<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Nguyễn Văn thêm',
                'email' => 'themvn1968@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$.ZVU7o1rQ/xA49fiTQbLBuiDxV3pMljFEp4YRMJWY6L89vtvKtOjS',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}