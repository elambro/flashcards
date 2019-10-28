<?php

namespace App\Repositories\Interfaces;

use App\Card;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Score;
use App\User;
use Illuminate\Support\Collection;

interface ScoreRepositoryInterface extends RepositoryInterface {

	public function getByUser(User $user): Collection;

	public function getByCard(Card $card): Collection;

	public function forCardAndUser($userId, $cardId): Score;

	public function markCorrect(Score $score);

	public function markIncorrect(Score $score);

}