<?php
namespace App\Repositories;

use App\Card;
use App\Repositories\Interfaces\ScoreRepositoryInterface;
use App\Repositories\Repository;
use App\Score;
use App\User;
use Illuminate\Support\Collection;

class ScoreRepository extends Repository implements ScoreRepositoryInterface {

	protected $model = Score::class;

	public function getByUser(User $user): Collection {
		return $user->scores;
	}

	public function getByCard(Card $card): Collection {
		return $card->scores;
	}

	public function forCardAndUser($userId, $cardId): Score {
		return Score::firstOrNew([
			'user_id' => $userId,
			'card_id' => $cardId,
		]);
	}

	public function markCorrect(Score $score) {
		$score->fill([
			'times_shown' => $score->times_shown + 1,
			'times_correct' => $score->times_correct + 1,
		])->save();
	}

	public function markIncorrect(Score $score) {
		$score->fill([
			'times_shown' => $score->times_shown + 1,
		])->save();
	}

}