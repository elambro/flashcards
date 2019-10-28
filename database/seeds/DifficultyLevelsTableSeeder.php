<?php

use App\DifficultyLevel;
use Illuminate\Database\Seeder;

class DifficultyLevelsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(DifficultyLevel::class, 5)->create();
	}
}
