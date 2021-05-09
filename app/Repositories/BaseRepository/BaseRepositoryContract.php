<?php


namespace App\Repositories\BaseRepository;


use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Throwable;

interface BaseRepositoryContract
{
    /**
     * Get all items
     *
     * @param  string $columns specific columns to select
     * @param  string $orderBy column to sort by
     * @param  string $sort sort direction
     */
    public function getAll($columns = null, $orderBy = null, $sort = null);

    /**
     * Get paged items
     *
     * @param  integer $paged Items per page
     * @param  string $orderBy Column to sort by
     * @param  string $sort Sort direction
     */
    public function getPaginated($paged = 5, $orderBy = null, $sort = null);

    /**
     * Items for select options
     *
     * @param string $data column to display in the option
     * @param string $key column to be used as the value in option
     * @param string $orderBy column to sort by
     * @param string $sort sort direction
     * @return array  array with key value pairs
     */
    public function getForSelect(string $data, $key = 'id', $orderBy = null, $sort = null): array;

    /**
     * Get item by its id
     *
     * @param int $modelId
     */
    public function getById(int $modelId);

    /**
     * Get instance of model by column
     *
     * @param  mixed $term search term
     * @param  string $column column to search
     */
    public function getItemByColumn($term, $column = 'slug');

    /**
     * Get instance of model by column
     *
     * @param  mixed $term search term
     * @param  string $column column to search
     */
    public function getCollectionByColumn($term, $column = 'slug');

    /**
     * Get item by id or column
     *
     * @param  mixed $term id or term
     * @param  string $column column to search
     */
    public function getActively($term, $column = 'slug');

    /**
     * Create new using mass assignment
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * This methods add new item for the has many relation
     *
     * @param HasMany $relation
     * @param array $data
     * @return Model|null
     */
    public function createChild(HasMany $relation, array $data): ?Model;

    public function createChildren(HasMany $relation, array $data): Collection;

    /**
     * Update or crate a record and return the entity
     *
     * @param array $attributes
     * @param array $values
     * @return Model|null
     */
    public function updateOrCreate(array $attributes, array $values = []): ?Model;

    /**
     * @param Model $model
     * @param array $data
     * @return mixed
     */
    public function update(Model $model, array $data): ?Model;

    /**
     * @param $modelId
     * @param array $data
     * @return bool
     */
    public function updateMass($modelId, array $data): bool;

    /**
     * Delete a record by it's ID.
     *
     * @param $modelId
     * @return bool
     */
    public function deleteMass($modelId): bool;

    /**
     * Delete a record by its model
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool;

    public function withFilters($filter): BaseEloquentRepository;

    /**
     * @return BaseEloquentRepository
     */
    public function withTrashed(): BaseEloquentRepository;

    /**
     * @return BaseEloquentRepository
     */
    public function onlyTrashed(): BaseEloquentRepository;

    /**
     * @param $relationships
     * @return BaseEloquentRepository
     */
    public function with($relationships): BaseEloquentRepository;

    /**
     * @param array $requestArray
     */
    public function parseRequest(array $requestArray): void;

    /**
     * @throws Throwable
     */
    public function beginTransaction();

    /**
     * @throws Throwable
     */
    public function rollback();

    /**
     * @throws Throwable
     */
    public function commit();

    /**
     * @param Closure $closure
     * @throws Throwable
     */
    public function transaction(Closure $closure);
}
