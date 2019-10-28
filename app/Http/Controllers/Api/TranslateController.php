<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;
use App\Services\TranslateAdapter;
use App\Services\TranslateAdapterInterface;

class TranslateController extends Controller {

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:api');
	}

	public function __invoke(TranslationRequest $request) {
		return $this->client()->translate($request->q, $request->target, $request->source);
	}

	private function client(): TranslateAdapterInterface {
		return new TranslateAdapter();
	}

}