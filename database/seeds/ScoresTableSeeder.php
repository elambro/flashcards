<?php

use App\Card;
use App\Score;
use App\User;
use Illuminate\Database\Seeder;

class ScoresTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::pluck('id')->each(function ($userId) {
			Card::pluck('id')->each(function ($cardId) use ($userId) {
				factory(Score::class)->create([
					'user_id' => $userId,
					'card_id' => $cardId,
				]);
			});
		});
	}
}
