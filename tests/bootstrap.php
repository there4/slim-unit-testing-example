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

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');

define('APPLICATION_PATH', realpath(__DIR__ . '/..'));

$loader = require APPLICATION_PATH . '/vendor/autoload.php';
$loader->add(
    'There4\\Tests\\', 
    array(
        realpath('./tests/integration'),
        realpath('./tests/unit'),
        realpath('./tests/regression'),
    )
);

/* End of file bootstrap.php */
