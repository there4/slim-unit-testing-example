<?php

class PostMethodTest extends Slim_Framework_TestCase
{

    public function testSayHello()
    {
        $parameters = array('name' => 'William Edwards');
        $this->post('/say-hello', $parameters);
        $this->assertEquals(200, $this->response->status());
        $this->assertSame('Hello William Edwards', $this->response->body());
    }

    public function testIssue3()
    {
        $parameters = array('name' => 'William Edwards');
        $this->post('/issue3', $parameters);
        $this->assertEquals(200, $this->response->status());
        $this->assertSame('Hello William Edwards', $this->response->body());
    }
}

/* End of file GetMethodTest.php */
