<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class Member
 * @package App\Http\Middleware
 */
class Member
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Create new filter instance
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Hanle an incomming request
     *
     * @param $request
     * @param callable $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! \User::isAdmin()) {
            if ($request->ajax) {
                return response('Unauthorized.', 401);
            } else {
                \App::abort(401);
            }
        }

        return $next($request);
    }
}
