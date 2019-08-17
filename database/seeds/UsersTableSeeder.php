<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=array(
        	array(
              'name'=>'Room Admin',
        	  'email'=>'roomadmin@yahoo.com',
        	  'password'=>Hash::make('password123'),
        	  'role'=>'admin',
        	  'status'=>'active'  
        	),
        	array(
              'name'=>'Room Vendor',
        	  'email'=>'roomvendor@yahoo.com',
        	  'password'=>Hash::make('password123'),
        	  'role'=>'vendor',
        	  'status'=>'active'  
        	),
          array(
              'name'=>'Room Vendor1',
            'email'=>'roomvendor1@yahoo.com',
            'password'=>Hash::make('password123'),
            'role'=>'vendor',
            'status'=>'active'  
          ),
        	array(
              'name'=>'Room User',
        	  'email'=>'roomuser@yahoo.com',
        	  'password'=>Hash::make('password123'),
        	  'role'=>'user',
        	  'status'=>'active'  
        	)
        );
        DB::table('users')->insert($array);
    }
}
