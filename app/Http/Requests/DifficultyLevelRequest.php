<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DifficultyLevelRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|string|max:50',
			'order' => 'nullable|integer|min:0',
			'handicap' => 'nullable|integer',
		];
	}
}
