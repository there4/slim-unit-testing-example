<?php
//
// SlimPHP Example Application
// =============================================================================
//
// * Author: [Craig Davis](craig@there4development.com)
// * Since: 10/2/2013
//
// -----------------------------------------------------------------------------
require_once '../vendor/autoload.php';

$composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'));

// These config values come from Apache environment vars. Set these in the
// apache config file. Don't forget a graceful restart if you make changes.
$app = new \Slim\Slim(array(
    'version'     => $composer->version,
    'debug'       => false
));

require_once __DIR__ . '/../app/app.php';

$app->run();

/* End of file index.php */
