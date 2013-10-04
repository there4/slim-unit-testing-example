<?php
//
// SlimPHP Example Application
// =============================================================================
//
// * Author: [Craig Davis](craig@there4development.com)
// * Since: 10/2/2013
//
// -----------------------------------------------------------------------------

// Dependency Injection Containers

$app->curl = function ($c) use ($app) {
    return new \Curl();
};


// Error Handler for any uncaught exception
// -----------------------------------------------------------------------------
// This can be silenced by turning on Slim Debugging. All exceptions thrown by
// our app will be collected here.
$app->error(function (\Exception $e) use ($app) {
    $app->response->setStatus(500);
    include __DIR__ . '/views/error.php';
});


// Site Root
// -----------------------------------------------------------------------------
// Heartbeat endpoint, should always return 200
$app->get('/version', function () use ($app) {
    echo $app->config('version');
});


/* End of file app.php */
