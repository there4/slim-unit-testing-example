<?php

class VersionTest extends LocalWebTestCase
{
    public function testVersion()
    {
        $this->client->get('/version');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals($this->app->config('version'), $this->client->response->body());
    }
}

/* End of file VersionTest.php */
