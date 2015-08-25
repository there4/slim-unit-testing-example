<?php

class OptionsMethodTest extends LocalWebTestCase
{
    public function testCORS()
    {
        $this->client->options('/cors');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertSame('*', $this->client->response->headers['Access-Control-Allow-Origin']);
    }
}

/* End of file OptionsMethodTest.php */
