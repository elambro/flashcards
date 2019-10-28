<?php

namespace App\Policies;

use App\DifficultyLevel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DifficultyLevelPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any difficulty levels.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user) {
		return true;
	}

	/**
	 * Determine whether the user can view the difficulty level.
	 *
	 * @param  \App\User  $user
	 * @param  \App\DifficultyLevel  $difficultyLevel
	 * @return mixed
	 */
	public function view(User $user, DifficultyLevel $difficultyLevel) {
		return true;
	}

	/**
	 * Determine whether the user can create difficulty levels.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		return $user->is_admin;
	}

	/**
	 * Determine whether the user can update the difficulty level.
	 *
	 * @param  \App\User  $user
	 * @param  \App\DifficultyLevel  $difficultyLevel
	 * @return mixed
	 */
	public function update(User $user, DifficultyLevel $difficultyLevel) {
		return $user->is_admin;
	}

	/**
	 * Determine whether the user can delete the difficulty level.
	 *
	 * @param  \App\User  $user
	 * @param  \App\DifficultyLevel  $difficultyLevel
	 * @return mixed
	 */
	public function delete(User $user, DifficultyLevel $difficultyLevel) {
		return $user->is_admin;
	}

	/**
	 * Determine whether the user can restore the difficulty level.
	 *
	 * @param  \App\User  $user
	 * @param  \App\DifficultyLevel  $difficultyLevel
	 * @return mixed
	 */
	public function restore(User $user, DifficultyLevel $difficultyLevel) {
		return $user->is_admin;
	}

	/**
	 * Determine whether the user can permanently delete the difficulty level.
	 *
	 * @param  \App\User  $user
	 * @param  \App\DifficultyLevel  $difficultyLevel
	 * @return mixed
	 */
	public function forceDelete(User $user, DifficultyLevel $difficultyLevel) {
		return $user->is_admin;
	}
}
