<?php

use Tier\InjectionParams;

// These classes will only be created once by the injector.
$shares = [
    'Jig\JigRender',
    'Jig\Jig',
    'Jig\JigConverter',
    'ScriptHelper\ScriptInclude',
    'ScriptHelper\ScriptVersion',
    'Room11\HTTP\VariableMap',
    'Room11\HTTP\HeadersSet',
    'Psr\Http\Message\ServerRequestInterface',
    new \ASM\File\SessionFilePath(__DIR__."/../var/session/"),
    new \FileFilter\YuiCompressorPath("/usr/lib/yuicompressor.jar"),
    new \Jig\JigTemplatePath(__DIR__."/../templates/"),
    new \Jig\JigCompilePath(__DIR__."/../var/compile/"),
    new \Tier\Path\AutogenPath(__DIR__.'/../autogen/'),
    new \Tier\Path\CachePath(__DIR__.'/../var/cache/'),
    new \Tier\Path\ExternalLibPath(__DIR__.'/../lib/'),
    new \Tier\Path\WebRootPath(__DIR__.'/../public/'),
];

// Alias interfaces (or classes) to the actual types that should be used 
// where they are required. 
$aliases = [
    'ASM\Driver' => 'ASM\File\FileDriver',
    //'ASM\Driver' => 'ASM\Redis\RedisDriver',
    'Jig\Escaper' => 'Jig\Bridge\ZendEscaperBridge',
    'Room11\HTTP\VariableMap' => 'Room11\HTTP\VariableMap\PSR7VariableMap',
    'Room11\HTTP\RequestHeaders' => 'Room11\HTTP\Request\HTTPRequestHeaders',
    'ScriptHelper\FilePacker' => 'ScriptHelper\FilePacker\YuiFilePacker',
    'ScriptHelper\ScriptURLGenerator' => 'ScriptHelper\ScriptURLGenerator\StandardScriptURLGenerator',
    'ScriptHelper\ScriptVersion' => 'ScriptHelper\ScriptVersion\DateScriptVersion',
    'TierJigSkeleton\Repository\UserRepo' => 'TierJigSkeleton\Repository\Stub\UserStubRepo',
    'Zend\Diactoros\Response\EmitterInterface' => 'Zend\Diactoros\Response\SapiEmitter',
];

// Delegate the creation of types to callables.
$delegates = [
    'ASM\Session' => ['TierJigSkeleton\App', 'createSession'],
    'Jig\JigConfig' => ['TierJigSkeleton\App', 'createJigConfig'],
    'ScriptHelper\ScriptInclude' => ['TierJigSkeleton\App', 'createScriptInclude'],
    'FastRoute\Dispatcher' => ['TierJigSkeleton\App', 'createDispatcher'],
];

// Define some params that can be injected purely by name.
$params = [];

$prepares = [
    'Jig\Jig' =>  ['TierJigSkeleton\App', 'prepareJig'],
];

$defines = [];

$injectionParams = new InjectionParams(
    $shares,
    $aliases,
    $delegates,
    $params,
    $prepares,
    $defines
);

return $injectionParams;
