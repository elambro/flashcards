<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Card extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {

		return [

			$this->merge(parent::toArray($request)),

			'side_1_sound_url' => $this->when($this->side_1_sound, function () {
				return Storage::disk('audio')->url($this->side_1_sound);
			}),

			'side_2_sound_url' => $this->when($this->side_2_sound, function () {
				return Storage::disk('audio')->url($this->side_2_sound);
			}),

			'score' => $this->whenLoaded('authUserScore', function () {
				return $this->authUserScore->percentage;
			}),

		];
	}

}
