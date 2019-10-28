<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\RepositoryInterface;
use App\User;
use Illuminate\Support\Collection;

interface CardRepositoryInterface extends RepositoryInterface {

	public function getByUser(User $user): Collection;

}