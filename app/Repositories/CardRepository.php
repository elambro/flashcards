<?php
namespace App\Repositories;

use App\Card;
use App\Category;
use App\Repositories\Interfaces\CardRepositoryInterface;
use App\Repositories\Repository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CardRepository extends Repository implements CardRepositoryInterface {

	protected $model = Card::class;

	public function getByUser(User $user): Collection {
		return $user->cards;
	}

	public function paginateForGame(Request $request) {

		$query = Auth::user()->cards()->with('authUserScore');

		// Add in category request
		if ($request->has('category_id')) {
			$this->queryOnCategory($query, $request->category_id);
		}

		if ($request->has('language')) {
			$this->queryOnLanguage($query, $request->language);
		}

		$this->randomize($query, $request->seed);

		return $query->simplePaginate($this->perPage);
	}

	private function randomize($query, $seed) {
		return $query->inRandomOrder($seed);
	}

	private function queryOnLanguage($query, $language) {

		if (is_null($language)) {
			return $query;
		}

		$query->where(function ($query) use ($language) {
			$query->where('side_2_language_code', $language)
				->orWhere('side_1_language_code', $language);
		});

		return $query;
	}

	private function queryOnCategory($query, $category_id) {

		if (is_null($category_id)) {
			return $query->doesntHave('categories');
		}

		$cat = Category::findOrFail($category_id);
		$cat_ids = $cat->descendants()->pluck('id');
		$cat_ids->push($cat->getKey());
		return $query->whereHas('categories', function ($query) use ($cat_ids) {
			$query->whereIn('id', $cat_ids->toArray());
		});
	}

}