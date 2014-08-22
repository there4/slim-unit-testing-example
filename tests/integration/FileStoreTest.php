<?php

class FileStoreTest extends LocalWebTestCase
{
    const AUTH_PASS = true;
    const AUTH_FAIL = false;

    private function setAuthenticationMock($response)
    {
        $auth = $this->getMock('\There4\Authentication\Cookie');
        $auth->expects($this->any())->method('authenticate')->will($this->returnValue($response));
        $this->app->authentication = function ($c) use ($auth) {
            return $auth;
        };
    }

    public function testAuthenticationFailureGets401()
    {
        $this->setAuthenticationMock(self::AUTH_FAIL);
        $this->client->get('/files/sample.json');
        $this->assertEquals(401, $this->client->response->status());
    }

    public function testCanDownloadFile()
    {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $expected = file_get_contents(__DIR__ . '/../../file_store/sample.json');
        $this->client->get('/files/sample.json');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals('application/json', $this->client->response['Content-Type']);
        $this->assertEquals($expected, $this->client->response->body());
    }

    public function testMissingFileGets404()
    {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $this->client->get('/files/four04.json');
        $this->assertEquals(404, $this->client->response->status());
    }

    public function testUnknownFileTypeGetsCorectHeader()
    {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $expected = file_get_contents(__DIR__ . '/../../file_store/unknownfile.type');
        $this->client->get('/files/unknownfile.type');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertEquals('application/octet-stream', $this->client->response['Content-Type']);
        $this->assertEquals($expected, $this->client->response->body());
    }
}

/* End of file FileStoreTest.php */
