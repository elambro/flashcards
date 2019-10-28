<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Score;
use App\Http\Resources\Scores;
use App\Repositories\ScoreRepository;
use App\Score as Model;

class ScoreController extends RestController {
	/**
	 * The repository instance.
	 */
	protected $repo;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource = Score::class;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource = Scores::class;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(ScoreRepository $repo) {
		parent::__construct($repo);
		$this->authorizeResource(Model::class, 'score');
	}
}
