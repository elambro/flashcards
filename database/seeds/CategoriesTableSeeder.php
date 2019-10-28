<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(Category::class, 5)
			->create(['parent_id' => null])
			->each(function ($category) {
				factory(Category::class, 5)
					->create(['parent_id' => $category->id])
					->each(function ($child) {
						factory(Category::class, 5)
							->create(['parent_id' => $child->id]);
					});
			});
	}
}
