<?php

// What about a PHPUnit custom set of assertions?
//   $this->assertResponseStatus($response, 200);
//   $this->assertResponseBody($response, $this->app->config('version'));

class VersionTest extends Slim_Framework_TestCase {

    public function testVersion() {
        $this->get('/version');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals($this->app->config('version'), $this->response->body());
    }

}

/* End of file VersionTest.php */
