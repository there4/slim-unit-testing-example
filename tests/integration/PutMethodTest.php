<?php

class PutMethodTest extends LocalWebTestCase
{
    public function testSayHello()
    {
        $parameters = array('name' => 'William Edwards');
        $this->client->put('/say-hello', $parameters, array('CONTENT_TYPE' => 'application/x-www-form-urlencoded'));
        $this->assertEquals(200, $this->client->response->status());
        $this->assertSame('Hello William Edwards', $this->client->response->body());
    }
}

/* End of file PutMethodTest.php */
