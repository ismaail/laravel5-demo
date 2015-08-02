<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Class Book
 * @package App
 */
class Book extends Model implements SluggableInterface
{
    use SluggableTrait;

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
     * Generate slug from title
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

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

    /**
     * Find book by slug or fail to 404 page
     *
     * @param string $slug
     *
     * @return Book
     */
    public static function findBySlugOrFail($slug)
    {
        try {
            $book = self::findBySlug($slug);

            return $book;

        } catch (ModelNotFoundException $e) {
            \App::abort(404, $e->getMessage());
        }
    }
}
