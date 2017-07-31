<?php

namespace RuffleLabs\ProductCore\Repositories;

use RuffleLabs\ProductCore\Models\Product;
use RuffleLabs\ProductCore\Repositories\Contracts\RepositoryInterface;


class RepositoryBase implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $item;

    /**
     * with eager loadings
     *
     * @var array
     */
    protected $with = [];

    /**
     * returns a collection of all models
     *
     * @return Collection
     */
    public function all()
    {
        return $this->item->all();
    }

    /**
     * returns the model found
     *
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        $query = $this->make();
        return $query->findOrFail($id);
    }

    /**
     * returns the repository itself, for fluent interface
     *
     * @param array $with
     * @return self
     */
    public function with(array $with)
    {
        $this->with = array_merge($this->with, $with);
        return $this;
    }

    /**
     * returns the first model found by conditions
     *
     * @param string $key
     * @param mixed $value
     * @param string $operator
     * @return Model
     */
    public function findFirstBy($key, $value, $operator = '=')
    {
        $query = $this->make();
        return $query->where($key, $operator, $value)->first();
    }

    /**
     * returns all models found by conditions
     *
     * @param string $key
     * @param mixed $value
     * @param string $operator
     * @return Collection
     */
    public function findAllBy($key, $value, $operator = '=')
    {
        $query = $this->make();
        return $query->where($key, $operator, $value)->get();
    }

    /**
     * returns all models that have a required relation
     *
     * @param string $relation
     * @return Collection
     */
    public function has($relation)
    {
        $query = $this->make();
        return $query->has($relation)->get();
    }

    /**
     * returns paginated result
     *
     * @param int $page
     * @param int $limit
     * @return PaginatedInterface
     */
    public function getPaginated($page = 1, $limit = 10)
    {
        $query = $this->make();
        $collection = $query->forPage($page, $limit)->get();
        return new PaginatedResult($page, $limit, $collection->count(), $collection);
    }

    /**
     * returns the query builder with eager loading, or the model itself
     *
     * @return Builder|Model
     */
    protected function make()
    {
        return $this->item->with($this->with);
    }

    /**
     * return results where the string parameter is found in the model's search fields
     *
     * @param $string
     * @return Model
     */
    public function search($string)
    {
        return $this->make()->where(function(Builder $query) use ($string)
        {
            foreach ($this->item->searchFields as $field)
            {
                $query->orWhere($field, 'LIKE', '%' . $string . '%' );
            }
        })->paginate();
    }

    /**
     * Create a new model.
     *
     * @param $input
     * @return static
     */
    public function create($input)
    {
        return $this->item->create($input);
    }

    /**
     * Update the model using the fill method.
     * @param $id
     * @param $input
     * @return \Illuminate\Support\Collection|static
     */
    public function update($id, $input)
    {
        $model = $this->item->find($id);
        $model->fill($input);
        $model->save();
        return $model;
    }

    /**
     * Delete the specified model
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->item->destroy($id);
    }

    /**
     * Return a set of paginated results for an index page.
     *
     * @return mixed
     */
    public function index()
    {
        $model = $this->item;
        if (method_exists($model, 'scopeFilter'))
        {
            $model->filter();
        }
        return $model->paginate();
    }

}
