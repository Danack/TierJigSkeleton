<?php

use Tier\Executable;
use Tier\TierHTTPApp;
use Tier\Tier;
use Room11\HTTP\Request\CLIRequest;

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

// Create the first Tier Executable that needs to be run.
$executable = new Executable(['Tier\JigBridge\JigRouter', 'routeRequest']);
$app->addGenerateBodyExecutable($executable);

$app->addBeforeSendExecutable('TierJigSkeleton\App::addSessionHeader');
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
