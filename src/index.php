<?php

ini_set('display_errors', 'off');
define('COMPOSER_OPCACHE_OPTIMIZE', true);

use Tier\Tier;
use Tier\TierApp;

require_once realpath(__DIR__).'/../vendor/autoload.php';

// Contains helper functions for the 'framework'.
require __DIR__."/../vendor/danack/tier/src/Tier/tierFunctions.php";

\Tier\setupErrorHandlers();

// Contains helper functions for the application.
require_once "appFunctions.php";

// Read application config params
$injectionParams = require_once "injectionParams.php";

// Create the first Tier that needs to be run.
$tier = new Tier('routeRequest');

// Create the Tier application
$app = new TierHTTPApp($tier, $injectionParams);

// The default exception handlers are good enough
$app->setStandardExceptionHandlers();

$request = \Tier\createRequestFromGlobals();

// Run it
$app->execute($request);
