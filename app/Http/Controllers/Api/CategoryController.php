<?php

namespace App\Http\Controllers\Api;

use App\Category as Model;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Categories;
use App\Http\Resources\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends RestController {
	/**
	 * The category repository instance.
	 */
	protected $repo;

	/**
	 * The form request class name
	 * @var string
	 */
	protected $form = CategoryRequest::class;

	/**
	 * The Resource class name
	 * @var string
	 */
	protected $resource = Category::class;

	/**
	 * The Collection Resource class name
	 * @var string
	 */
	protected $collectionResource = Categories::class;

	/**
	 * Create a new controller instance.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(CategoryRepository $repo) {
		parent::__construct($repo);
		$this->authorizeResource(Model::class, 'category');
	}
}
