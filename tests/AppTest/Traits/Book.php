<?php

namespace AppTest\Traits;

/**
 * Class Book
 * @package AppTest\Traits
 */
trait Book
{
    /**
     * Create new book(s)
     *
     * @param array $data
     */
    public function createBooks($data)
    {
        \App\Book::create($data);
    }

    /**
     * Empty Book table
     */
    public function clearBooks()
    {
        \App\Book::truncate();
    }
}
