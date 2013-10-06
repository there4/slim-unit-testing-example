<?php

class FileStoreTest extends Slim_Framework_TestCase {

    const AUTH_PASS = true;
    const AUTH_FAIL = false;

    private function setAuthenticationMock($passFail) {
        $auth = $this->getMock('\There4\Authentication\Cookie');
        $auth->expects($this->any())->method('authenticate')->will($this->returnValue($passFail));
        $this->app->authentication = function ($c) use ($auth) {
            return $auth;
        };
    }

    public function testAuthenticationFailureGets401() {
        $this->setAuthenticationMock(self::AUTH_FAIL);
        $this->get('/files/sample.json');
        $this->assertEquals(401, $this->response->status());
    }

    public function testCanDownloadFile() {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $expected = file_get_contents(__DIR__ . '/../../file_store/sample.json');
        $this->get('/files/sample.json');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals('application/json', $this->response['Content-Type']);
        $this->assertEquals($expected, $this->response->body());
    }

    public function testMissingFileGets404() {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $this->get('/files/four04.json');
        $this->assertEquals(404, $this->response->status());
    }

    public function testUnknownFileTypeGetsCorectHeader() {
        $this->setAuthenticationMock(self::AUTH_PASS);
        $expected = file_get_contents(__DIR__ . '/../../file_store/unknownfile.type');
        $this->get('/files/unknownfile.type');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals('application/octet-stream', $this->response['Content-Type']);
        $this->assertEquals($expected, $this->response->body());
    }

}

/* End of file FileStoreTest.php */
