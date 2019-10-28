<?php

namespace App\Nova;

use App\Nova\Actions\AddCategoryToCard;
use App\Nova\Actions\FetchSoundForCard;
use Davidpiesse\Audio\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Card extends Resource {
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Card';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'id',
		'side_1',
		'side_2',
	];

	/**
	 * Get the value that should be displayed to represent the resource.
	 *
	 * @return string
	 */
	public function title() {
		return Str::limit($this->side_1, 20);
	}

	/**
	 * Get the URI key for the resource.
	 *
	 * @return string
	 */
	public static function uriKey() {
		return 'kard';
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function fields(Request $request) {

		$langs = [
			'en-US' => 'English',
			'ru-RU' => 'Russian',
			'de-DE' => 'German',
			'es-MX' => 'Spanish',
			'fr-FR' => 'French',
		];

		return [
			ID::make()->sortable(),

			Text::make('Title', function () {
				return Str::limit($this->side_1, 20);
			})->onlyOnIndex(),

			Textarea::make('A', 'side_1')->sortable(),

			Select::make('Lang A', 'side_1_language_code')->options($langs)->displayUsingLabels()->sortable(),

			Textarea::make('Instructions A', 'side_1_instructions')->nullable()->hideFromIndex(),

			Textarea::make('B', 'side_2')->sortable(),

			Select::make('Lang B', 'side_2_language_code')->options($langs)->displayUsingLabels()->sortable(),

			Textarea::make('Instructions B', 'side_2_instructions')->nullable()->hideFromIndex(),

			Boolean::make('Reverse', 'is_reversable'),

			BelongsTo::make('Author', 'createdByUser', 'App\Nova\User')->sortable()->hideFromIndex(),

			BelongsTo::make('Difficulty', 'difficultyLevel', 'App\Nova\DifficultyLevel')->sortable()->nullable(),

			Number::make('# Cats', function () {
				return $this->categories()->count();
			})->onlyOnIndex(),

			Boolean::make('Audio A', function () {
				return $this->side_1_sound ? true : false;
			})->onlyOnIndex(),

			Boolean::make('Audio A', function () {
				return $this->side_1_sound ? true : false;
			})->onlyOnIndex(),

			Audio::make('Audio A', 'side_1_sound')->disk('audio')->onlyOnDetail(),
			Audio::make('Audio B', 'side_2_sound')->disk('audio')->onlyOnDetail(),

			BelongsToMany::make('Categories'),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function cards(Request $request) {
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function filters(Request $request) {
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function lenses(Request $request) {
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function actions(Request $request) {
		return [
			new FetchSoundForCard,
			new AddCategoryToCard,
		];
	}
}
