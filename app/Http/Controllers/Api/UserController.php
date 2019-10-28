<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Resources\User;
use App\Http\Resources\Users;
use App\Repositories\UserRepository;
use App\User as Model;
use Illuminate\Http\Request;

class UserController extends RestController {

	/**
	 * The card repository instance.
	 */
	protected $repo;

	/**
	 * The form request class name
	 * @var string
	 */
	protected $form = UserRequest::class;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource = User::class;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource = Users::class;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(UserRepository $repo) {
		parent::__construct($repo);
		$this->authorizeResource(Model::class, 'user');
	}

	public function user(Request $request) {
		$user = $request->user();
		$this->authorize('view', $user);
		return parent::show($user);
	}

}
