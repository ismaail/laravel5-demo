<?php
namespace App\Http\Requests;

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
            'title'       => 'required|min:3|unique:book',
            'description' => 'required',
            'pages'       => 'required|integer',
        ];
    }
}
