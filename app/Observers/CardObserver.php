<?php

namespace App\Observers;

use App\Card;
use App\Jobs\AddSoundFileToCard;
use Illuminate\Support\Facades\Auth;

class CardObserver {
	/**
	 * Handle the card "creating" event.
	 *
	 * @param  \App\Card  $card
	 * @return void
	 */
	public function creating(Card $card) {
		if (!$card->created_by_user_id) {
			$card->created_by_user_id = Auth::id();
		}
	}

	/**
	 * Handle the card "created" event.
	 *
	 * @param  \App\Card  $card
	 * @return void
	 */
	public function created(Card $card) {
		AddSoundFileToCard::dispatch($card);
	}

}
