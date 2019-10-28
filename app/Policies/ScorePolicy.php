<?php

namespace App\Policies;

use App\Score;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScorePolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any scores.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user) {
		return $user->is_admin;
	}

	/**
	 * Determine whether the user can view the score.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Score  $score
	 * @return mixed
	 */
	public function view(User $user, Score $score) {
		return $user->is_admin || $score->user_id === $user->id;
	}

	/**
	 * Determine whether the user can create scores.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		return false;
	}

	/**
	 * Determine whether the user can update the score.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Score  $score
	 * @return mixed
	 */
	public function update(User $user, Score $score) {
		return false;
	}

	/**
	 * Determine whether the user can delete the score.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Score  $score
	 * @return mixed
	 */
	public function delete(User $user, Score $score) {
		return false;
	}

	/**
	 * Determine whether the user can restore the score.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Score  $score
	 * @return mixed
	 */
	public function restore(User $user, Score $score) {
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the score.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Score  $score
	 * @return mixed
	 */
	public function forceDelete(User $user, Score $score) {
		return false;
	}
}
