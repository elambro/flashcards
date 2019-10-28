<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use App\DifficultyLevel;
use App\User;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {

	$russian = Factory::create('ru_RU');

	return [
		'side_1' => $faker->word,
		'side_2' => $russian->word,
		'side_2_language_code' => 'ru_RU',
		'is_reversable' => $faker->boolean(90),
		'created_by_user_id' => User::inRandomOrder()->value('id') ?: 1,
		'difficulty_level_id' => DifficultyLevel::inRandomOrder()->value('id'),
	];
});
