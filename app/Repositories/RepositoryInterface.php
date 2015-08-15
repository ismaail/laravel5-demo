<?php
namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package Repositories
 */
interface RepositoryInterface
{
    /**
     * Find all records
     *
     * @param array $columns
     *
     * @return array
     */
    public function all($columns = ['*']);

    /**
     * Find all records with pagination
     *
     * @param int $perPage
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*']);

    /**
     * Find record by id
     *
     * @param integer $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException     If record not found
     */
    public function find($id, $columns = ['*']);

    /**
     * Fidn record by field
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException     If record not found
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     * Create new record
     *
     * @param array $data
     */
    public function create(array $data);

    /**
     * Update a record
     *
     * @param integer $id
     * @param array $data
     */
    public function update($id, array $data);

    /**
     * Remove a record
     *
     * @param integer $id
     */
    public function delete($id);
}
