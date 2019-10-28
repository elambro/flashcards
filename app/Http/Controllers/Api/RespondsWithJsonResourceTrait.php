<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Model;

trait RespondsWithJsonResourceTrait {

	/**
	 * Get the resource for returning a collection
	 * @param  Collection|Paginator $collection [description]
	 * @return ResourceCollection
	 */
	protected function collection($collection) {
		if (property_exists($this, 'collectionResource') && $this->collectionResource) {
			$rc = $this->collectionResource;
			return new $rc($collection);
		} else if (property_exists($this, 'resource') && $this->resource) {
			$r = $this->resource;
			return $r::collection($collection);
		} else {
			return $collection;
		}
	}

	/**
	 * Get the resource for returning a single model instance
	 * @param  Model $model
	 * @return JsonResource
	 */
	protected function single(Model $model) {
		if (property_exists($this, 'resource') && $this->resource) {
			$r = $this->resource;
			return new $r($model);
		} else {
			return $model;
		}
	}
}
