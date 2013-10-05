<?php

class FileStoreTest extends Slim_Framework_TestCase {

    public function testCanDownloadFile() {
        $expected = file_get_contents(__DIR__ . '/../../file_store/sample.json');
        $this->get('/files/sample.json');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals('application/json', $this->response['Content-Type']);
        $this->assertEquals($expected, $this->response->body());
    }

    public function testMissingFileGets404() {
        $this->get('/files/four04.json');
        $this->assertEquals(404, $this->response->status());
    }

    public function testUnknownFileTypeGetsCorectHeader() {
        $expected = file_get_contents(__DIR__ . '/../../file_store/unknownfile.type');
        $this->get('/files/unknownfile.type');
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals('application/octet-stream', $this->response['Content-Type']);
        $this->assertEquals($expected, $this->response->body());
    }

}

/* End of file FileStoreTest.php */
