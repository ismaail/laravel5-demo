<?php
namespace App\Repositories;

use App\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository implements RepositoryInterface
{
    /**
     * Find all records
     *
     * @param array $columns
     *
     * @return array
     */
    public function all($columns = ['*'])
    {
        return Book::all($columns);
    }

    /**
     * Find all records with pagination
     *
     * @param int $perPage
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return \DB::table('book')->paginate($perPage, $columns);
    }

    /**
     * Find book by id
     *
     * @param integer $id
     * @param array $columns
     *
     * @return Book
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException     If record not found
     */
    public function find($id, $columns = ['*'])
    {
        $book = Book::find($id, $columns);

        if (is_null($book)) {
            throw new ModelNotFoundException("Book not found");
        }

        return $book;
    }

    /**
     * Fidn record by field
     *
     * @param string $field
     * @param string $value
     * @param array $columns
     *
     * @return Book
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException     If record not found
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        $book = Book::where($field, $value, $columns)->first();

        if (is_null($book)) {
            throw new ModelNotFoundException("Book not found");
        }

        return $book;
    }

    /**
     * Find book by slug
     *
     * @param string $slug
     *
     * @return Book
     */
    public function findBySlug($slug)
    {
        return $this->findBy('slug', $slug);
    }

    /**
     * Find book by slug or redirect to 404 page
     *
     * @param string $slug
     *
     * @return Book
     */
    public function findBySlugOrFail($slug)
    {
        try {
            return $this->findBySlug($slug);

        } catch (ModelNotFoundException $e) {
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * Create new book
     *
     * @param array $data
     *
     * @return Book
     */
    public function create(array $data)
    {
        return Book::create($data);
    }

    /**
     * Update a book
     *
     * @param string $slug
     * @param array $data
     *
     * @return Book
     */
    public function update($slug, array $data)
    {
        $book = $this->findBySlugOrFail($slug);

        $book->update($data);

        return $book;
    }

    /**
     * Remove a book by slug
     *
     * @param string $slug
     */
    public function delete($slug)
    {
        $book = $this->findBySlugOrFail($slug);

        $book->destroy($book->id);
    }
}
