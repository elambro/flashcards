<?php

namespace App\Http\Resources;

use App\Http\Requests\UserRequest;
use App\Http\Resources\User;

class Users extends ResourceCollection {
	/**
	 * The class name of the FormRequest class
	 * @var string
	 */
	protected $formRequest = UserRequest::class;

	/**
	 * The resource that this resource collects.
	 *
	 * @var string
	 */
	public $collects = User::class;
}
