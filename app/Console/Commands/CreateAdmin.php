<?php

namespace App\Console\Commands;

use App\Jobs\CreateAdmin as CreateAdminJob;
use Illuminate\Console\Command;

class CreateAdmin extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'superuser';

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
		CreateAdminJob::dispatch('erinlambro@gmail.com');
	}
}
