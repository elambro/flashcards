<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface RepositoryInterface {

	public function all($columns = array('*')): Collection;

	public function find($id, $columns = array('*')): Model;

	public function create(array $attributes): Model;

	public function update(Model $model, array $attributes): Model;

	public function destroy($ids): int;

	public function delete(Model $model): bool;

	public function save(Model $model): Model;

	public function updateFromRequest(Model $model, Request $request);

	public function createFromRequest(Request $request);
}