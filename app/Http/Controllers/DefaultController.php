<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Config;

/**
 * Class DefaultController
 * @package App\Http\Controllers
 */
class DefaultController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('default/index');
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
