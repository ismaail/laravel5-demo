<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
}
