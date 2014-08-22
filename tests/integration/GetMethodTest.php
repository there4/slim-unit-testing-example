<?php

class GetMethodTest extends LocalWebTestCase
{
    public function testSayHello()
    {
        $this->client->get('/say-hello/William');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertSame('Hello William', $this->client->response->body());
    }
}

/* End of file GetMethodTest.php */
