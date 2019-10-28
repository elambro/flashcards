<?php

namespace App;

use App\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model {
	use NodeTrait;

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
	];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Get cards in this category
	 * @return BelongsToMany
	 */
	public function cards(): BelongsToMany {
		return $this->belongsToMany(Card::class);
	}

	public function getDepthLabelAttribute() {
		return str_repeat('- ', $this->depth ?? 0) . $this->name;
	}
}
