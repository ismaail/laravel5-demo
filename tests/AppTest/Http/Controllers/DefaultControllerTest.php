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
