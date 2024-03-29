<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Card' => 'App\Policies\CardPolicy',
		'App\Category' => 'App\Policies\CategoryPolicy',
		'App\DifficultyLevel' => 'App\Policies\DifficultyLevelPolicy',
		'App\Score' => 'App\Policies\ScorePolicy',
		'App\User' => 'App\Policies\UserPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->registerPolicies();

		//
	}
}
