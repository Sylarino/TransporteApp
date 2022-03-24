<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Domain\System\User\User;
class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role = Sentinel::findRoleBySlug('super-admin');
		$user = User::where('email','maxi.rebolledo@gmail.com')->first();

		$role->users()->attach($user->id);
    }
}
