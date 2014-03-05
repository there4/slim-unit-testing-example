<?php

namespace There4\Tests\Authentication;

use There4\Authentication\Cookie;

class CookieTest extends \PHPUnit_Framework_TestCase
{
    public function testAuthenticate()
    {
        $cookie = new Cookie();
        $this->assertFalse($cookie->authenticate('token'));
    }
}

/* End of file CookieTest.php */
