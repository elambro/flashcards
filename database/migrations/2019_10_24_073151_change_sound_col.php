<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSoundCol extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('cards', function (Blueprint $table) {
			$table->dropColumn('side_1_sound');
			$table->dropColumn('side_2_sound');
		});
		Schema::table('cards', function (Blueprint $table) {
			$table->string('side_1_sound')->nullable();
			$table->string('side_2_sound')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('cards', function (Blueprint $table) {
			$table->dropColumn('side_1_sound');
			$table->dropColumn('side_2_sound');
		});
		Schema::table('cards', function (Blueprint $table) {
			$table->binary('side_1_sound')->nullable();
			$table->binary('side_2_sound')->nullable();
		});
	}
}
