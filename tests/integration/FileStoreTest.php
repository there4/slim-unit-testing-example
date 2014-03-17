<?php

use There4\Slim\Test\WebTestCase;

class FileStoreTest extends WebTestCase
{
    const AUTH_PASS = true;
    const AUTH_FAIL = false;

    public function getSlimInstance() {
        // Initialize our own copy of the slim application
        $app = new \Slim\Slim(array(
            'version'        => '0.0.0',
            'debug'          => false,
            'mode'           => 'testing',
            'templates.path' => __DIR__ . '/../app/templates'
        ));

        // Include our core application file
        require PROJECT_ROOT . '/app/app.php';
        return $app;
    }

    private function setAuthenticationMock($passFail)
    {
        $auth = $this->getMock('\There4\Authentication\Cookie');
        $auth->expects($this->any())->method('authenticate')->will($this->returnValue($passFail));
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
