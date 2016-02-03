<?php

use Tier\Tier;
use Tier\TierHTTPApp;
use Room11\HTTP\Request\CLIRequest;

ini_set('display_errors', 'on');

require_once realpath(__DIR__).'/../vendor/autoload.php';

Tier::setupErrorHandlers();

//We are now capable of handling errors gracefully.
ini_set('display_errors', 'off');

// Load the application configuration
$appEnvIncluded = @include_once __DIR__."/../autogen/appEnv.php";
if (!$appEnvIncluded) {
    //In a non-skeleton app, we would not need to have conditional includes
    require_once __DIR__."/appEnv.php";
}

// In a real project include the applications secret keys
// from a location outside of the VCS controlled directories.
//require_once __DIR__."/../appKeys.php";

// Read application config params
$injectionParams = require_once "injectionParams.php";

// Create the Tier application
$app = new TierHTTPApp($injectionParams);

// Make the body that is generated be shared by TierApp
$app->addExpectedProduct('Room11\HTTP\Body');

// Create the routing Executable. This will create an executable that
// will generate the body of the response.
$app->addRoutingExecutable(['Tier\JigBridge\JigRouter', 'routeRequest']);

// Add an executable to save the session the generate the appropriate headers 
$app->addBeforeSendExecutable('TierJigSkeleton\App::addSessionHeader');

// Add an executable to send the response
$app->addSendExecutable(['Tier\Tier', 'sendBodyResponse']);

//Create the request
if (strcasecmp(PHP_SAPI, 'cli') == 0) {
    $request = new CLIRequest('/notepad', 'example.com');
}
else {
    $request = Tier::createRequestFromGlobals();
}

// Run it
$app->execute($request);
