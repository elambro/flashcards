<?php

namespace App;

use App\Category;
use App\DifficultyLevel;
use App\Score;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Card extends Model {
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'side_1' => 'string',
		'side_2' => 'string',
		'side_1_language_code' => 'string',
		'side_2_language_code' => 'string',
		'is_reversable' => 'boolean',
		'created_by_user_id' => 'integer',
		'difficulty_level_id' => 'integer',
	];

	/**
	 * The model's default values for attributes.
	 *
	 * @var array
	 */
	protected $attributes = [
		'side_2_language_code' => 'en-US',
		'side_1_language_code' => 'en-US',
	];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Get cards in this difficulty level
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function difficultyLevel(): BelongsTo {
		return $this->belongsTo(DifficultyLevel::class);
	}

	/**
	 * Get the user that created the card
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function createdByUser(): BelongsTo {
		return $this->belongsTo(User::class, 'created_by_user_id');
	}

	/**
	 * Get scores for this card
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function scores(): HasMany {
		return $this->hasMany(Score::class);
	}

	/**
	 * Get the score for this card of the current user
	 */
	public function authUserScore() {
		return $this->hasOne(Score::class)->where('user_id', Auth::id())->withDefault([
			'user_id' => Auth::id(),
			'card_id' => $this->id,
		]);
	}

	/**
	 * Get categories for this card
	 * @return BelongsToMany
	 */
	public function categories(): BelongsToMany {
		return $this->belongsToMany(Category::class);
	}

}
