<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Repository;
use App\User;

class UserRepository extends Repository implements UserRepositoryInterface {

	protected $model = User::class;
}