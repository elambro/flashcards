<?php

namespace App\Console\Commands;

use App\Card;
use App\Jobs\AddSoundFileToCard;
use Illuminate\Console\Command;

class AddTextToSpeech extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'add-sound {card=all}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$cardId = $this->argument('card');
		if ($cardId === 'all') {
			Card::whereNull('side_1_sound')->orWhereNull('side_2_sound')->chunk(10, function ($cards) {
				$cards->each(function ($card) {
					AddSoundFileToCard::dispatchNow($card);
					$this->info('Dispatched card # ' . $card->id);
				});
			});
		} else {
			AddSoundFileToCard::dispatchNow(Card::find($cardId));
		}

	}
}
