<?php

class PostMethodTest extends LocalWebTestCase
{
    public function testSayHello()
    {
        $parameters = array('name' => 'William Edwards');
        $this->client->post('/say-hello', $parameters);
        $this->assertEquals(200, $this->client->response->status());
        $this->assertSame('Hello William Edwards', $this->client->response->body());
    }

    public function testIssue3()
    {
        $parameters = array('name' => 'William Edwards');
        $this->client->post('/issue3', $parameters);
        $this->assertEquals(200, $this->client->response->status());
        $this->assertSame('Hello William Edwards', $this->client->response->body());
    }
}

/* End of file PostMethodTest.php */
