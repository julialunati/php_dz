<?php

namespace Project\Account\Model;

use PHPUnit\Framework\TestCase;
use Project\Account\Model\Auth;

class AuthTest extends TestCase
{
    private $object;

    protected function setUp() : void
    {
        $this->object = new Auth();
    }

    private function clearSession()
    {
        if (isset($_SESSION)) {
            unset($_SESSION);
        }
    }

    public function testIsAuth(): void
    {
        $this->assertFalse(
            $this->object->isAuth()
        );

        $_SESSION['user_id'] = 1;

        $this->assertTrue(
            $this->object->isAuth()
        );
    }

    public function testGetUserId(): void
    {
        $this->assertNull(
            $this->object->getUserId()
        );

        $_SESSION['user_id'] = 2;

        $this->assertEquals(
            2,
            $this->object->getUserId()
        );
        $this->clearSession();
    }

    public function tearDown(): void
    {
        $this->clearSession();
    }
}