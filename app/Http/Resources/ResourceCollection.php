<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as Base;

abstract class ResourceCollection extends Base {

	/**
	 * The class name of the FormRequest class
	 * @var string
	 */
	protected $formRequest;

	protected function getRules(): array{
		return $this->formRequest ? (new $this->formRequest)->rules() : [];
	}

	/**
	 * Transform the resource collection into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'data' => $this->collection,
			'meta' => [
				// validation rules to use on the front end forms
				'rules' => $this->getRules(),
			],
		];
	}
}
