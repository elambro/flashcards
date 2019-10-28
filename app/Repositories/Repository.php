<?php
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class Repository implements RepositoryInterface {

	protected $model;

	protected $perPage = 10;

	public function __construct($instance = null) {
		$m = $this->model;
		$this->model = $instance ?? new $m;
	}

	public function paginate($columns = array('*')): Paginator {
		return $this->model->simplePaginate($this->perPage);
	}

	public function all($columns = array('*')): Collection {
		return $this->model->all($columns);
	}

	public function find($id, $columns = array('*')): Model {
		return $this->model->find($id, $columns);
	}

	public function create(array $attributes): Model {
		return $this->model->create($attributes);
	}

	public function update(Model $model, array $attributes): Model {
		return $this->save($model->fill($attributes));
	}

	public function destroy($ids): int {
		return $this->model->destroy($ids);
	}

	public function delete(Model $model): bool {
		return $model->delete();
	}

	public function save(Model $model): Model{
		$model->save();
		return $model;
	}

	public function updateFromRequest(Model $model, Request $request) {
		return $this->update($model, $request->validated());
	}

	public function createFromRequest(Request $request) {
		return $this->create($request->validated());
	}

	public function setPerPage($number) {
		$this->perPage = $number;
		return $this;
	}
}