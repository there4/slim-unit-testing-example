<?php

class SlimTest extends Slim_Framework_TestCase {

    public function testVersion() {
        $this->get('/version');
        //$this->assertEquals('200', $this->response->status());
        $this->assertEquals($this->app->config('version'), $this->response->body());
    }

}

/* End of file SlimTest.php */
