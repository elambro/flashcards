<?php

namespace App\Nova\Actions;

use App\Repositories\CategoryRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Nova;

class AddCategoryToCard extends Action {
	use InteractsWithQueue, Queueable;

	/**
	 * Perform the action on the given models.
	 *
	 * @param  \Laravel\Nova\Fields\ActionFields  $fields
	 * @param  \Illuminate\Support\Collection  $models
	 * @return mixed
	 */
	public function handle(ActionFields $fields, Collection $models) {
		$catId = $fields->category;
		foreach ($models as $model) {
			$model->categories()->syncWithoutDetaching([$catId]);
		}
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields() {
		return [
			Select::make('Category')
				->options(resolve(CategoryRepository::class)->all()->pluck('depth_label', 'id'))
				->rules('required', 'exists:categories,id'),
		];
	}
}
