<?php

namespace App\Jobs;

use App\Repositories\Interfaces\ScoreRepositoryInterface;
use App\Repositories\ScoreRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncorrectAnswer implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $cardId;
	protected $authId;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($authId, $cardId) {
		$this->authId = $authId;
		$this->cardId = $cardId;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		$repo = $this->repo();
		$score = $repo->forCardAndUser($this->authId, $this->cardId);
		$repo->markIncorrect($score);
	}

	private function repo(): ScoreRepositoryInterface {
		return resolve(ScoreRepository::class);
	}
}
