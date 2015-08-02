<?php
namespace App\Http\Requests;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        switch ($this->method()) {
            case 'PUT':
                return [
                    'title'       => "required|min:3|unique:book,title,{$this->getBookTitle()},title",
                    'description' => 'required',
                    'pages'       => 'required|integer',
                ];

            default:
                return [
                    'title'       => 'required|min:3|unique:book,title',
                    'description' => 'required',
                    'pages'       => 'required|integer',
                ];
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
        $book = \App\Book::findBySlugOrFail($slug);

        return $book->title;
    }
}
