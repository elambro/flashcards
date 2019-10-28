<?php

namespace App\Providers;

use App\Repositories\CardRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DifficultyLevelRepository;
use App\Repositories\Interfaces\CardRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\DifficultyLevelRepositoryInterface;
use App\Repositories\Interfaces\ScoreRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ScoreRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			CardRepositoryInterface::class,
			CardRepository::class
		);
		$this->app->bind(
			CategoryRepositoryInterface::class,
			CategoryRepository::class
		);
		$this->app->bind(
			DifficultyLevelRepositoryInterface::class,
			DifficultyLevelRepository::class
		);
		$this->app->bind(
			ScoreRepositoryInterface::class,
			ScoreRepository::class
		);
		$this->app->bind(
			UserRepositoryInterface::class,
			UserRepository::class
		);
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}
}
