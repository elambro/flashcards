<?php

namespace App;

use App\Card;
use App\DifficultyLevel;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Score extends Model {
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'user_id' => 'integer',
		'card_id' => 'integer',
		'times_shown' => 'integer',
		'times_correct' => 'integer',
	];
	/**
	 * The model's default values for attributes.
	 *
	 * @var array
	 */
	protected $attributes = [
		'times_shown' => 0,
		'times_correct' => 0,
	];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'card_id',
		'times_shown',
		'times_correct',
	];

	/**
	 * Get cards in this difficulty level
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function card(): BelongsTo {
		return $this->belongsTo(Card::class);
	}

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function difficultyLevel(): HasOneThrough {
		return $this->hasOneThrough(DifficultyLevel::class, Card::class);
	}

	public function getPercentageAttribute() {
		return $this->times_shown ? (round($this->times_correct / $this->times_shown * 100)) : null;
	}
}
