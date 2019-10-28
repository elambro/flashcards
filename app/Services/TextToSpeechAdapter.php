<?php

namespace App\Services;

use App\Services\TextToSpeechAdapterInterface;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class TextToSpeechAdapter implements TextToSpeechAdapterInterface {

	private $client;
	private $effectsProfileId = "telephony-class-application";
	private $voiceGender = SsmlVoiceGender::FEMALE;
	private $audioEncoding = AudioEncoding::MP3;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->client = $this->client();
	}

	public function fetchAudioFromText($text, $language) {
		$response = $this->client()->synthesizeSpeech($this->text($text), $this->voice($language), $this->config());
		return $response->getAudioContent();
	}

	/**
	 * Initiate the text to speech client
	 * @return TextToSpeechClient
	 */
	private function client(): TextToSpeechClient {
		return new TextToSpeechClient(googleCloudCredentials());
	}

	/**
	 * Build the voice request, and the ssml voice gender
	 * @param  string $language [description]
	 * @return VoiceSelectionParams
	 */
	private function voice($language): VoiceSelectionParams {
		return (new VoiceSelectionParams())->setSsmlGender($this->voiceGender)->setLanguageCode($language);
	}

	/**
	 * Get the Audio Config - select the type of audio file you want returned
	 * @return AudioConfig
	 */
	private function config(): AudioConfig {
		return (new AudioConfig())
			->setAudioEncoding($this->audioEncoding)
			->setEffectsProfileId(array($this->effectsProfileId));
	}

	/**
	 * Get the text class
	 * @param  string $text
	 * @return SynthesisInput
	 */
	private function text($text): SynthesisInput {
		return (new SynthesisInput())->setText($text);
	}
}
