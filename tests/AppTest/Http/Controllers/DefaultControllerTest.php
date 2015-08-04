<?php
namespace AppTest\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class DefaultControllerTest
 * @package App\Http\Controllers
 */
class DefaultControllerTest extends \TestCase
{
    private function mockUserRoleIsAdmin()
    {
        \User::shouldReceive('isAdmin')
                ->once()
                ->andReturn(true);
    }

    private function mockUserRoleIsNotAdmin()
    {
        \User::shouldReceive('isAdmin')
                ->once()
                ->andReturn(false);
    }

    /**
     * @group DefaultController@index
     */
    public function testActionIndexIsAccessibleNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        $this->call('GET', '/');

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@index
     */
    public function testActionIndexIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();

        $this->call('GET', '/');

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@show
     */
    public function testActionShowIsAccessibleByNonAdmin()
    {
        $this->markTestIncomplete('must mock Book Model');

        $this->mockUserRoleIsNotAdmin();
        $this->mockBookFindBySlug();

        $this->call('GET', '/books/book-title');

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@show
     */
    public function testActionShowIsAccessibleByAdmin()
    {
        $this->markTestIncomplete('must mock Book Model');

        $this->mockUserRoleIsAdmin();
        $this->mockBookFindBySlug();

        $this->call('GET', '/books/book-title');

        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@create
     */
    public function testActionCreateIsNotAccessibleByNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        $this->call('GET', '/books/create');

        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@create
     */
    public function testActionCreateIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();

        $this->call('GET', '/books/create');

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@store
     */
    public function testActionStoreIsNotAccessibleByNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('POST', '/books', $requestParams);

        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@store
     */
    public function testActionStoreIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('POST', '/books', $requestParams);

        $this->assertResponseStatus(302);
    }
}
