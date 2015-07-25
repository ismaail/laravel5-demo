<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Book;
use App\Exceptions\ApplicationException;

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
     * @param string $to
     * @param string $subject
     * @param array $body
     */
    private function sendEmail($to, $subject, $body)
    {
        Mail::send('emails/blank', ['body' => $body], function (Message $message) use ($to, $subject) {
            $mailConfig = Config::get('mail');

            $message->from($mailConfig['from']['address'], $mailConfig['from']['name']);
            $message->to($to)
                    ->subject($subject);
        });
    }
}
