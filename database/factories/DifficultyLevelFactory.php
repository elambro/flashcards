<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DifficultyLevel;
use Faker\Generator as Faker;

$factory->define(DifficultyLevel::class, function (Faker $faker) {
	return [
		'name' => $faker->word,
		'order' => $faker->randomDigit,
		'handicap' => $faker->boolean(50) ? $faker->randomDigit : 0,
	];
});
