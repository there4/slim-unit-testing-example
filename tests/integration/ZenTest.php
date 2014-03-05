<?php

use There4\Tests\SlimFrameworkTestCase;

class ZenTest extends SlimFrameworkTestCase
{
    // Use dependency injection to mock the Curl object.
    public function testCanFetchZenFromGitHub()
    {
        $expected = 'Never sniff a gift fish.';
        $curl = $this->getMock('\Curl');
        $curl->expects($this->any())
            ->method('get')
            ->will($this->returnValue((object) array(
                'headers' => array('Status-Code' => 200),
                'body'    => $expected
            )));
        $this->app->curl = function ($c) use ($curl) {
            return $curl;
        };

        $this->get('/zen');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals($expected, $this->response->body());
    }

    public function testZenResponseWhenGitHubFails()
    {
        $curl = $this->getMock('\Curl');
        $curl->expects($this->any())
            ->method('get')
            ->will($this->returnValue((object) array(
                'headers' => array('Status-Code' => 503),
                'body'    => ''
            )));
        $this->app->curl = function ($c) use ($curl) {
            return $curl;
        };

        $this->get('/zen');
        $this->assertEquals(502, $this->response->status());
    }
}

/* End of file ZenTest.php */
