<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use App\Score;
use App\User;
use Faker\Generator as Faker;

$factory->define(Score::class, function (Faker $faker) {
	$times_shown = $faker->randomNumber;
	return [
		'user_id' => User::inRandomOrder()->value('id'),
		'card_id' => Card::inRandomOrder()->value('id'),
		'times_shown' => $times_shown,
		'times_correct' => $faker->numberBetween(0, $times_shown),
	];
});
