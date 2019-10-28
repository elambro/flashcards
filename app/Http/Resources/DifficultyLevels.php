<?php

namespace App\Http\Resources;

use App\Http\Requests\DifficultyLevelRequest;
use App\Http\Resources\DifficultyLevel;

class DifficultyLevels extends ResourceCollection {
	/**
	 * The class name of the FormRequest class
	 * @var string
	 */
	protected $formRequest = DifficultyLevelRequest::class;

	/**
	 * The resource that this resource collects.
	 *
	 * @var string
	 */
	public $collects = DifficultyLevel::class;
}
