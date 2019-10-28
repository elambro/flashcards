<?php

namespace App\Nova\Actions;

use App\Jobs\AddSoundFileToCard;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class FetchSoundForCard extends Action {
	use InteractsWithQueue, Queueable;

	/**
	 * Perform the action on the given models.
	 *
	 * @param  \Laravel\Nova\Fields\ActionFields  $fields
	 * @param  \Illuminate\Support\Collection  $models
	 * @return mixed
	 */
	public function handle(ActionFields $fields, Collection $models) {
		foreach ($models as $model) {
			AddSoundFileToCard::dispatchNow($model);
		}
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields() {
		return [];
	}
}
