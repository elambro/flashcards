<?php

namespace App\Services;

interface TextToSpeechAdapterInterface {

	public function fetchAudioFromText($text, $language);

}
