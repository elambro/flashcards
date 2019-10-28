<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class CreateAdmin implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $email;
	private $password;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($email, $password = 'secret') {
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		$user = User::create([
			'name' => 'Admin',
			'email' => $this->email,
			'password' => Hash::make($this->password),
			'is_admin' => true,
		]);
		$user->email_verified_at = now();
		$user->api_token = Str::random(60);
		$user->save();
	}
}
