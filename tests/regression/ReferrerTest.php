<?php

// [issue 12](https://github.com/there4/slim-unit-testing-example/issues/12)
class ReferrerTest extends LocalWebTestCase
{
    public function testCanSetReferrer()
    {
        $qs = array('');
        $referer = array('HTTP_REFERER' => 'hello');
        $this->client->get('/issue12', $qs, $referer);
        print_r($this->client->app->request->headers);
        $this->assertEquals('hello', $this->client->response->body());
    }
}

/* End of file ReferrerTest.php */
