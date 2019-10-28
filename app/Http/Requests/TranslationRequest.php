<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'source' => 'required|string|min:2|max:5',
			'target' => 'required|string|min:2|max:5',
			'q' => 'required|string',
		];
	}
}
