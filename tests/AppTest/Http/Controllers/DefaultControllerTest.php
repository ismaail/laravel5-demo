<?php
namespace AppTest\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use AppTest\Traits;

/**
 * Class DefaultControllerTest
 * @package App\Http\Controllers
 */
class DefaultControllerTest extends \TestCase
{
    use Traits\Member;
    use Traits\Book;

    public function tearDown()
    {
        $this->clearBooks();

        parent::tearDown();
    }

    private function createSingleBook()
    {
        $this->createBooks([
            'title'       => 'Book Title',
            'description' => 'Book Description',
            'pages'       => 0,
        ]);
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
        $this->mockUserRoleIsNotAdmin();
        $this->createSingleBook();

        $this->call('GET', '/books/book-title');

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@show
     */
    public function testActionShowIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();
        $this->createSingleBook();

        $this->call('GET', '/books/book-title');

        $this->assertResponseOk();
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
