<?php

namespace App\Jobs;

use App\Card;
use App\Services\TextToSpeechAdapter;
use App\Services\TextToSpeechAdapterInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

final class AddSoundFileToCard implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $card;
	private $storageDisk = 'audio';

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Card $card) {
		$this->card = $card;
	}

	/**
	 * Execute the job.
	 * Call Google's API and save the resulting sound file
	 *
	 * @return void
	 */
	public function handle() {

		$adapter = new TextToSpeechAdapter();

		if ($this->card->side_1_language_code !== 'en-US') {
			$this->card->side_1_sound = $this->fetchAudioForSide($adapter, 1);
		}

		if ($this->card->side_2_language_code !== 'en-US') {
			$this->card->side_2_sound = $this->fetchAudioForSide($adapter, 2);
		}

		$this->card->save();
	}

	private function fetchAudioForSide(TextToSpeechAdapterInterface $adapter, int $side) {
		$text = $this->card['side_' . $side];
		$lang = $this->card['side_' . $side . '_language_code'];

		$filename = 'card_' . $this->card->id . '_side_' . $side . '.mp3';

		$audio = $adapter->fetchAudioFromText($text, $lang);

		Storage::disk($this->storageDisk)->put($filename, $audio);

		return $filename;
	}

}
