<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Book
 * @package App
 */
class Book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'pages',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Find All books
     *
     * @param int $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function findAll($limit)
    {
        return \DB::table('book')->paginate($limit);
    }

    /**
     * Find Book by slug
     *
     * @param string $slug
     *
     * @return Book
     */
    public static function findBySlug($slug)
    {
        $book = self::where('slug', $slug)->first();

        if (is_null($book)) {
            throw new ModelNotFoundException("Book not found");
        }

        return $book;
    }
}
