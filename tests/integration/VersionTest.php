<?php

use There4\Tests\SlimFrameworkTestCase;

class VersionTest extends SlimFrameworkTestCase
{
    public function testVersion()
    {
        $this->get('/version');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals($this->app->config('version'), $this->response->body());
    }
}

/* End of file VersionTest.php */
