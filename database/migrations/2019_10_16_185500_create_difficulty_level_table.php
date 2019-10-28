<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifficultyLevelTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('difficulty_levels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 50);
			$table->smallInteger('order')->default(0);
			$table->smallInteger('handicap')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('difficulty_levels');
	}
}
