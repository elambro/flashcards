<?php
namespace App\Repositories;

use App\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class CategoryRepository extends Repository implements CategoryRepositoryInterface {
	protected $model = Category::class;

	public function all($columns = array('*')): Collection{

		$nodes = $this->model->withDepth()->get($columns)->toTree();

		$return = collect([]);

		$traverse = function ($categories, $prefix = '-') use (&$traverse, &$return) {
			foreach ($categories as $category) {
				$return->push($category);
				$traverse($category->children, $prefix . '-');
			}
		};

		$traverse($nodes);

		return $return;
	}
}