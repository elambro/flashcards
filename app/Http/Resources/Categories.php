<?php

namespace App\Http\Resources;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category;

class Categories extends ResourceCollection {
	/**
	 * The class name of the FormRequest class
	 * @var string
	 */
	protected $formRequest = CategoryRequest::class;

	public $collects = Category::class;
}
