<?php

namespace App\Http\Resources;

use App\Http\Resources\Score;

class Scores extends ResourceCollection {

	/**
	 * The resource that this resource collects.
	 *
	 * @var string
	 */
	public $collects = Score::class;

}
