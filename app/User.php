<?php

namespace App;

use App\Score;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'is_admin',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Get scores for this user on all cards
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function scores(): HasMany {
		return $this->hasMany(Score::class);
	}

	/**
	 * Get cards created by this user
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cards(): HasMany {
		return $this->hasMany(Card::class, 'created_by_user_id');
	}
}
