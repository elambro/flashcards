<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('/user', 'UserController@user');

Route::name('api.')->group(function () {

	// Route::get('cards/sound/{card}/{side}', 'PlayController@soundFor')->name('soundfile');

	Route::apiResources([
		'cards' => 'CardController',
		'categories' => 'CategoryController',
		'difficulty-levels' => 'DifficultyLevelController',
		'users' => 'UserController',
	]);

	Route::apiResource('scores', 'ScoreController')->only(['show', 'index']);

	Route::post('correct/{card_id}', 'PlayController@correct');
	Route::post('incorrect/{card_id}', 'PlayController@incorrect');
	Route::get('play/cards', 'PlayController@cards');
	Route::post('translate', 'TranslateController');

});
