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
            $book = Book::findBySlugOrFail($slug);

            return View('default/show', compact('book'));
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BookRequest $request)
    {
        $input = $request->all();

        $book = Book::create($input);

        return redirect('/books/' . $book->slug);
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $book = Book::findBySlugOrFail($slug);

        return View('default/edit', compact('book'));
    }

    /**
     * Update book
     *
     * @param string $slug
     * @param BookRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($slug, BookRequest $request)
    {
        $book = Book::findBySlugOrFail($slug);

        $book->update($request->all());

        return redirect('/books/' . $book->slug);
    }

    /**
     * Delete book
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $book = Book::findBySlugOrFail($slug);

        $book->destroy($book->id);

        return redirect('/');
    }
}
