<?php

namespace AppTest\Traits;

/**
 * Class MemberTrait
 * @package AppTest
 */
trait Member
{
    public function mockUserRoleIsAdmin()
    {
        \User::shouldReceive('isAdmin')
            ->once()
            ->andReturn(true);
    }

    public function mockUserRoleIsNotAdmin()
    {
        \User::shouldReceive('isAdmin')
            ->once()
            ->andReturn(false);
    }
}
