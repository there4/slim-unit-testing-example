<?php

class ZenTest extends LocalWebTestCase
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

        $this->client->get('/zen');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals($expected, $this->client->response->body());
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

        $this->client->get('/zen');
        $this->assertEquals(502, $this->client->response->status());
    }
}

/* End of file ZenTest.php */
