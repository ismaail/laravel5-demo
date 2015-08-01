<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Book;
use App\Exceptions\ApplicationException;
use App\Http\Requests\BookRequest;

/**
 * Class DefaultController
 * @package App\Http\Controllers
 */
class DefaultController extends Controller
{
    /**
     * @return \Illuminate\View\View
     *
     * @throws ApplicationException
     */
    public function index()
    {
        $bookConfig = $this->getBookPaginationConfig();

        if (! isset($bookConfig['pagination']['limit'])) {
            throw new ApplicationException("Book configuration for pagination limitation not set");
        }

        $books = Book::findAll($bookConfig['pagination']['limit']);

        return view('default/index', compact('books'));
    }

    /**
     * Get Book configuration
     *
     * @return array
     *
     * @throws ApplicationException     If Book config is not set
     */
    private function getBookPaginationConfig()
    {
        if (! Config::has('book')) {
            throw new ApplicationException("Book configuration not set");
        }

        return Config::get('book');
    }

    /**
     * Show Book details page
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        try {
            $book = Book::findBySlug($slug);

            return View('default/show', compact('book'));

        } catch (ModelNotFoundException $e) {
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * Create new book
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View('default/create');
    }

    /**
     * Save new book
     *
     * @param BookRequest $request
     *
     * @return string
     */
    public function store(BookRequest $request)
    {
        $input = $request->all();

        $book = Book::create($input);

        return redirect('/books/' . $book->slug);
    }
}
