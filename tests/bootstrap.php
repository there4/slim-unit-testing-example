<?php
//
// Unit Test Bootstrap and Slim PHP Testing Framework
// =============================================================================
//
// SlimpPHP is a little hard to test - but with this harness we can load our
// routes into our own `$app` container for unit testing, and then `run()` and
// hand a reference to the `$app` to our tests so that they have access to the
// dependency injection container and such.
//
// * Author: [Craig Davis](craig@there4development.com)
// * Since: 10/2/2013
//
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../vendor/autoload.php';

class Slim_Framework_TestCase extends PHPUnit_Framework_TestCase {

    // Initialize our own copy of the slim application
    public function setup() {
        $app = new \Slim\Slim(array(
            'version' => '0.0.0',
            'debug'   => false,
            'mode'    => 'testing'
        ));

        require __DIR__ . '/../app/app.php';

        // Establish a local reference to the Slim app object
        $this->app = $app;
    }

    // Abstract way to make a request to SlimPHP, this allows us to mock the
    // slim environment
    public function request($method, $path, $options = array()) {
        // Capture STDOUT
        ob_start();

        // Prepare a mock environment
        \Slim\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO'      => $path,
            'SERVER_NAME'    => 'local.dev',
        ), $options));

        // Establish some useful references to the slim app properties
        $this->request  = $this->app->request();
        $this->response = $this->app->response();

        // Execute our app
        $this->app->run();

        // Return the application output. Also available in `response->body()`
        return ob_get_clean();
    }

    public function get($path, $options = array()) {
        return $this->request('GET', $path, $options);
    }

    public function post($path, $options = array(), $postVars = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('POST', $path, $options);
    }

    public function patch($path, $options = array(), $postVars = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PATCH', $path, $options);
    }

    public function put($path, $options = array(), $postVars = array()) {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PUT', $path, $options);
    }

    public function delete($path, $options = array()) {
        return $this->request('POST', $path, $options);
    }

    public function head($path, $options = array()) {
        return $this->request('HEAD', $path, $options);
    }

}

/* End of file bootstrap.php */
