<?php

namespace App\Services;

use App\Services\TranslateAdapterInterface;
use Google\Cloud\Translate\TranslateClient;

class TranslateAdapter implements TranslateAdapterInterface {

	private $client;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->client = $this->client();
	}

	public function translate($text, $target, $source = null) {
		return $this->client->translate($text, [
			'target' => isoLanguageCode($target),
			'source' => $source ? isoLanguageCode($source) : null,
		]);
	}

	/**
	 * Initiate the text to speech client
	 * @return TranslateClient
	 */
	private function client(): TranslateClient {
		return new TranslateClient(googleCloudCredentials());
	}

}
