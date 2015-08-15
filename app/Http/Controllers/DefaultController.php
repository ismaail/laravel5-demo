<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Config;
use App\Exceptions\ApplicationException;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;

/**
 * Class DefaultController
 * @package App\Http\Controllers
 */
class DefaultController extends Controller
{
    /**
     * @var BookRepository
     */
    protected $bookRepo;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('member', ['except' => ['index', 'show']]);

        $this->bookRepo = new BookRepository();
    }

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

        $books = $this->bookRepo->paginate($bookConfig['pagination']['limit']);

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
            $book = $this->bookRepo->findBySlugOrFail($slug);

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
        $book = $this->bookRepo->create($request->all());

        session()->flash('success_message', 'Book created successfully');

        return redirect('/books/' . $book->slug);
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $book =$this->bookRepo->findBySlugOrFail($slug);

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
        $book = $this->bookRepo->update($slug, $request->all());

        session()->flash('success_message', 'Book updated successfully');

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
        $this->bookRepo->delete($slug);

        session()->flash('success_message', 'Book removed successfully');

        return redirect('/');
    }
}
