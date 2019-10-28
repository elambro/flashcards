<?php

namespace App\Http\Resources;

use App\Http\Requests\CardRequest;
use App\Http\Resources\Card;

class Cards extends ResourceCollection {

	/**
	 * The resource that this resource collects.
	 *
	 * @var string
	 */
	public $collects = Card::class;

	/**
	 * The class name of the FormRequest class
	 * @var string
	 */
	protected $formRequest = CardRequest::class;

}
