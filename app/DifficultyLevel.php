<?php

namespace App;

use App\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DifficultyLevel extends Model {
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
		'order' => 'integer',
		'handicap' => 'integer',
	];
	/**
	 * The model's default values for attributes.
	 *
	 * @var array
	 */
	protected $attributes = [
		'order' => 0,
		'handicap' => 0,
	];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Get cards in this difficulty level
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cards(): HasMany {
		return $this->hasMany(Card::class);
	}
}
