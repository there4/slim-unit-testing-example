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


// Token Authentication
// -----------------------------------------------------------------------------
// Halt the response if the token is not valid.
$authenticate = function ($app) {
    return function () use ($app) {
        if (true) {
            return;
        }
        $app->halt(401, 'Invalid authentication token');
    };
};

// Version Endpoint
// -----------------------------------------------------------------------------
// Heartbeat endpoint, should always return 200
$app->get('/version', function () use ($app) {
    echo $app->config('version');
});


// Zen Statement From GitHub
// -----------------------------------------------------------------------------
// Can be used to verify that the application has external connectivity.
$app->get('/zen', function () use ($app) {
    $response = $app->curl->get('https://api.github.com/zen');
    if ($response->headers['Status-Code'] != 200) {
        $app->halt(502, 'GitHub has failed with :' + $response->headers['Status-Code']);
    }
    echo $response->body;
});


// Fetch a file from the file store.
// -----------------------------------------------------------------------------
// Authenticated request for a file from the file store
$app->get('/files/:filename', $authenticate($app), function ($filename) use ($app)  {
    $supported_types = (object) array(
        'json'    => 'application/json',
        'xml'     => 'application/xml',
        'csv'     => 'text/csv',
        'unknown' => 'application/octet-stream'
    );

    $filename = pathinfo($filename, PATHINFO_BASENAME);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $path = __DIR__ . '/../file_store/' . $filename;
    if (!file_exists($path)) {
        $app->notFound();
    }
    $content_type
        = property_exists($supported_types, $extension)
        ? $supported_types->$extension
        : $supported_types->unknown;

    $app->response->headers->set('Content-Type', $content_type);
    readfile($path);
});


/* End of file app.php */
