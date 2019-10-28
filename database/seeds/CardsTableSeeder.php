<?php

use App\Card;
use App\Category;
use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$category_ids = Category::pluck('id');
		factory(Card::class, 50)
			->create()
			->each(function ($card) use ($category_ids) {
				$card->categories()->sync($category_ids->random(3));
			});
	}
}
