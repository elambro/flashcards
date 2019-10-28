<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cards', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('side_1', 500);
			$table->string('side_1_language_code', 5)
				->default('en-US');
			$table->binary('side_1_sound')
				->nullable();

			$table->string('side_2', 500)
				->nullable();
			$table->string('side_2_language_code', 5)
				->default('en-US');
			$table->binary('side_2_sound')
				->nullable();

			$table->boolean('is_reversable')
				->default(false);
			$table->unsignedBigInteger('created_by_user_id');
			$table->unsignedBigInteger('difficulty_level_id')
				->nullable();
			$table->timestamps();

			$table->foreign('created_by_user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->foreign('difficulty_level_id')
				->references('id')
				->on('difficulty_levels')
				->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('cards');
	}
}
