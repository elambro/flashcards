<?php

namespace App\Http\Controllers\Api;

use App\DifficultyLevel as Model;
use App\Http\Requests\DifficultyLevelRequest;
use App\Http\Resources\DifficultyLevel;
use App\Http\Resources\DifficultyLevels;
use App\Repositories\DifficultyLevelRepository;

class DifficultyLevelController extends RestController {
	/**
	 * The repository instance.
	 */
	protected $repo;

	/**
	 * The form request class name
	 * @var string
	 */
	protected $form = DifficultyLevelRequest::class;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource = DifficultyLevel::class;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource = DifficultyLevels::class;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(DifficultyLevelRepository $repo) {
		parent::__construct($repo);
		$this->authorizeResource(Model::class, 'difficulty-level');
	}
}
