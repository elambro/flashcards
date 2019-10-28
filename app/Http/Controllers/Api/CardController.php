<?php

namespace App\Http\Controllers\Api;

use App\Card as Model;
use App\Http\Requests\CardRequest;
use App\Http\Resources\Card;
use App\Http\Resources\Cards;
use App\Repositories\CardRepository;
use Illuminate\Http\Request;

class CardController extends RestController {

	/**
	 * The card repository instance.
	 */
	protected $repo;

	/**
	 * The form request class name
	 * @var string
	 */
	protected $form = CardRequest::class;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource = Card::class;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource = Cards::class;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(CardRepository $repo) {
		parent::__construct($repo);
		$this->authorizeResource(Model::class, 'card');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\CardRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$category_id = $request->category_id;
		$resource = parent::store($request);
		if ($category_id) {
			$resource->resource->categories()->sync([$category_id]);
		}
		return $resource;
	}

}
