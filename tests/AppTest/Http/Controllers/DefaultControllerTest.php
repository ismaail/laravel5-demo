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

    /**
     * @var array
     */
    private $singleBook = [
        'data' => [
            'title'       => 'Book Title',
            'description' => 'Book Description',
            'pages'       => 0,
        ],
        'slug' => 'book-title',
    ];

    public function tearDown()
    {
        $this->clearBooks();

        parent::tearDown();
    }

    private function createSingleBook()
    {
        $this->createBooks($this->singleBook['data']);
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

        $this->call('GET', sprintf('/books/%s', $this->singleBook['slug']));

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@show
     */
    public function testActionShowIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();
        $this->createSingleBook();

        $this->call('GET', sprintf('/books/%s', $this->singleBook['slug']));

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@show
     */
    public function testActionShowReturn404IfBookDontExist()
    {
        $this->call('GET', '/book/do-not-exist-book');

        $this->assertResponseStatus(404);
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

    /**
     * @group DefaultController@edit
     */
    public function testActionEditIsNotAccessibleByNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        $this->call('GET', sprintf('/books/%s/edit', $this->singleBook['slug']));


        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@edit
     */
    public function testActionEditIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();
        $this->createSingleBook();

        $this->call('GET', sprintf('/books/%s/edit', $this->singleBook['slug']));

        $this->assertResponseOk();
    }

    /**
     * @group DefaultController@edit
     */
    public function testActionEditReturn404IfBookDontExist()
    {
        $this->mockUserRoleIsAdmin();

        $this->call('GET', '/books/do-not-exist-book/edit');

        $this->assertResponseStatus(404);
    }

    /**
     * @group DefaultController@update
     */
    public function testActionUpdateIsNotAccessibleByNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('PUT', '/books/book-title', $requestParams);

        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@update
     */
    public function testActionUpdateIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();
        $this->createSingleBook();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('PUT', sprintf('/books/%s', $this->singleBook['slug']), $requestParams);

        $this->assertResponseStatus(302);
    }

    /**
     * @group DefaultController@update
     */
    public function testActionUpdateReturn404IfBookDontExist()
    {
        $this->mockUserRoleIsAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('PUT', '/books/do-not-exist-book', $requestParams);

        $this->assertResponseStatus(404);
    }

    /**
     * @group DefaultController@destroy
     */
    public function testActionDestroyIsNotAccessibleByNonAdmin()
    {
        $this->mockUserRoleIsNotAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('DELETE', '/books/book-title', $requestParams);

        $this->assertResponseStatus(401);
    }

    /**
     * @group DefaultController@destroy
     */
    public function testActionDestroyIsAccessibleByAdmin()
    {
        $this->mockUserRoleIsAdmin();
        $this->createSingleBook();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('DELETE', sprintf('/books/%s', $this->singleBook['slug']), $requestParams);

        $this->assertResponseStatus(302);
    }

    /**
     * @group DefaultController@destroy
     */
    public function testActionDestroyReturn404IfBookDontExist()
    {
        $this->mockUserRoleIsAdmin();

        \Session::start();
        $requestParams = [
            '_token' => csrf_token(),
        ];

        $this->call('DELETE', '/books/do-not-exist-book', $requestParams);

        $this->assertResponseStatus(404);
    }
}
