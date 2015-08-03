<?php
namespace App\Member\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class User
 * @package App\Member\Facades
 */
class User extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}
