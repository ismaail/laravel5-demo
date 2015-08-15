<?php
namespace App\Http\Requests;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\BookRepository;

/**
 * Class BookRequest
 * @package App\Http\Requests
 */
class BookRequest extends Request
{
    /**
     * Determine if user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get tha validation rukes that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => $this->getTitleRule(),
            'description' => 'required',
            'pages'       => 'required|integer',
        ];
    }

    /**
     * Get the rule used to validate book title
     *
     * @return string
     */
    private function getTitleRule()
    {
        switch ($this->method()) {
            case 'PUT':
                return sprintf('required|min:3|unique:book,title,%s,title', $this->getBookTitle());

            default:
                return 'required|min:3|unique:book,title';
        }
    }

    /**
     * Get book title for current slug
     *
     * @return string
     *
     * @throws ModelNotFoundException   If book not found
     */
    private function getBookTitle()
    {
        $slug = \Request::route()->getParameter('slug');

        $bookRepo = new BookRepository();
        $book     = $bookRepo->findBySlugOrFail($slug);

        return $book->title;
    }
}
