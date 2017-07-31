<?php

namespace RuffleLabs\ProductCore\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {
    /**
     * returns a collection of all models
     *
     * @return Collection
     */
    public function all();

    /**
     * returns the model found
     *
     * @param int $id
     * @return Model
     */
    public function find($id);

    /**
     * returns the first model found by conditions
     *
     * @param string $key
     * @param mixed $value
     * @param string $operator
     * @return Model
     */
    public function findFirstBy($key, $value, $operator = '=');

    /**
     * returns all models found by conditions
     *
     * @param string $key
     * @param mixed $value
     * @param string $operator
     * @return Collection
     */
    public function findAllBy($key, $value, $operator = '=');

    /**
     * returns all models that have a required relation
     *
     * @param string $relation
     * @return Collection
     */
    public function has($relation);

    /**
     * @param int $page
     * @param int $limit
     * @return \KickDigital\Repositories\Contracts\PaginatedInterface
     */
    public function getPaginated($page = 1, $limit = 10);

    /**
     * @param string $string
     * @return Model
     */
    public function search($string);
    public function create($input);
    public function update($id, $input);
    public function destroy($id);
}
