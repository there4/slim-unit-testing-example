<?php

use There4\Tests\SlimFrameworkTestCase;

class GetMethodTest extends SlimFrameworkTestCase
{
    public function testSayHello()
    {
        $this->get('/say-hello/William');
        $this->assertEquals(200, $this->response->status());
        $this->assertSame('Hello William', $this->response->body());
    }
}

/* End of file GetMethodTest.php */
