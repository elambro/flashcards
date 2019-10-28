<?php

use App\Jobs\CreateAdmin;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		CreateAdmin::dispatchNow('admin@example.com');
		factory(User::class, 5)->create();
	}
}
