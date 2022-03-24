<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //insert admin user
	    Sentinel::registerAndActivate([
	    	'email' => 'maxi.rebolledo@gmail.com',
		    'first_name' => 'Maximiliano',
		    'last_name' => 'Rebolledo',
		    'password' => 'ws102030'
	    ]);
    }
}
