<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest {

	/**
	 * Get the validated data from the request.
	 *
	 * @return array
	 */
	public function validated() {
		return array_except(parent::validated(), 'category_id');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'side_1' => 'required|string|max:500',
			'side_2' => 'required|string|max:500',
			'side_1_language_code' => 'required|string|max:5|nullable',
			'side_2_language_code' => 'required|string|max:5|nullable',
			'side_1_instructions' => 'nullable|string|max:500',
			'side_2_instructions' => 'nullable|string|max:500',
			'is_reversable' => 'boolean',
			'category_id' => 'nullable|exists:categories,id',
			'difficulty_level_id' => 'required|exists:difficulty_levels,id',
		];
	}
}
