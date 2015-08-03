<?php
namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Class MemberServiceProvider
 * @package App\Providers
 */
class MemberServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        App::bind('user', function () {
            return new \App\Member\User;
        });
    }
}
