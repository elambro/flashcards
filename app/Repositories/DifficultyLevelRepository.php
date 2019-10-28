<?php
namespace App\Repositories;

use App\DifficultyLevel;
use App\Repositories\Interfaces\DifficultyLevelRepositoryInterface;
use App\Repositories\Repository;

class DifficultyLevelRepository extends Repository implements DifficultyLevelRepositoryInterface {
	protected $model = DifficultyLevel::class;
}