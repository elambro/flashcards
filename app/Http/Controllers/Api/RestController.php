<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\RespondsWithJsonResourceTrait;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class RestController extends Controller {

	use RespondsWithJsonResourceTrait;

	/**
	 * The repository instance.
	 * @var RepositoryInterface
	 */
	protected $repo;

	/**
	 * The form request class name
	 * @var string
	 */
	protected $form;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource;

	/**
	 * The name of the associated Model
	 * @var string
	 */
	protected $modelClassName;

	/**
	 * Create a new controller instance.
	 *
	 * @param  RepositoryInterface $repo
	 * @return void
	 */

	public function __construct(RepositoryInterface $repo) {
		$this->middleware('auth:api');

		if (is_callable('parent::__construct')) {
			parent::__construct();
		}
		$this->repo = $repo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		if (!$request->all) {
			return $this->paginate($request);
		}

		return $this->collection($this->repo->all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$model = $this->repo->createFromRequest($this->resolveFormRequest() ?? $request);
		return $this->single($model);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model  $model
	 * @return \Illuminate\Http\Response
	 */
	public function show(Model $model) {
		return $this->single($model);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model  $model
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Model $model) {
		$this->repo->updateFromRequest($model, $this->resolveFormRequest() ?? $request);
		return $this->single($model);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model  $model
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Model $model) {
		$this->repo->destroy($model);
		return $this->single($model);
	}

	/**
	 * Convert the given Request to the one specified in the overridden class property $form
	 *
	 * @param  Request $request [description]
	 * @return Request
	 */
	protected function resolveFormRequest():  ? FormRequest {
		if ($this->form) {
			return resolve($this->form);
		}
	}

	protected function paginate(Request $request) {

		$response = $this->collection($this->repo->paginate());

		$response->response()->setStatusCode(Response::HTTP_PARTIAL_CONTENT);

		return $response;
	}
}
