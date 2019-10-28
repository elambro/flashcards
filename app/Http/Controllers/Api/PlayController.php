<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cards;
use App\Jobs\CorrectAnswer;
use App\Jobs\IncorrectAnswer;
use App\Repositories\CardRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayController extends Controller {

	protected $repo;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(CardRepository $repo) {
		if (is_callable('parent::__construct')) {
			parent::__construct();
		}
		$this->middleware('auth:api');
		$this->repo = $repo;
	}

	public function incorrect(Request $request, $cardId) {

		IncorrectAnswer::dispatchNow($request->user()->id, $cardId);
	}

	public function correct(Request $request, $cardId) {

		CorrectAnswer::dispatchNow($request->user()->id, $cardId);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function cards(Request $request) {

		$this->authorize('viewAny', Card::class);

		$collection = $this->repo->paginateForGame($request);

		return (new Cards($collection))->response()->setStatusCode(Response::HTTP_PARTIAL_CONTENT);
	}

}
