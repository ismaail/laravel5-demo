<?php
namespace App\Member;

use App;
use Auth;

/**
 * Class User
 * @package App\Member
 */
class User
{
    /**
     * Check if connected user is Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        if (Auth::check()
            && App\User::ROLE_ADMIN === Auth::user()->roles
        ) {
            return true;
        }

        return false;
    }
}
