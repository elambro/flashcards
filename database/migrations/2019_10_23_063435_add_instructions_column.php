<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstructionsColumn extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('cards', function (Blueprint $table) {
			$table->string('side_1_instructions', 500)->nullable();
			$table->string('side_2_instructions', 500)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('cards', function (Blueprint $table) {
			$table->dropColumn('side_2_instructions');
			$table->dropColumn('side_1_instructions');
		});
	}
}
