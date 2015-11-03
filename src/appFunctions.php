<?php

use Amp\Artax\Client as ArtaxClient;
//use ArtaxServiceBuilder\ResponseCache;
//use Arya\Response;
use Jig\JigConfig;
use Jig\Jig;
//use Tier\ResponseBody\HtmlBody;
use Jig\JigBase;
use Tier\Tier;
use Tier\InjectionParams;
use Tier\Data\RouteList;
//use GithubService\GithubArtaxService\GithubService;
use Tier\Data\ErrorInfo;
use Room11\HTTP\Request;

use Intahwebz\Config;


/**
 * @return JigConfig
 */
function createJigConfig(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templates/",
        __DIR__."/../var/compile/",
        'tpl',
        $config->getKey(Config::JIG_COMPILE_CHECK)
    );

    return $jigConfig;
}



function routesFunction(\FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', '/', ['Intahwebz\Controller\Index', 'renderIndexPage']);
}




function routeRequest(Request $request)
{
    $dispatcher = \FastRoute\simpleDispatcher('routesFunction');
    $httpMethod = 'GET';
    $uri = '/';

    if (array_key_exists('REQUEST_URI', $_SERVER)) {
        $uri = $_SERVER['REQUEST_URI'];
    }
    
    // TODO - $request
    
    ///$uri = '/image/Imagick/adaptiveResizeImage';

    $path = $uri;
    $queryPosition = strpos($path, '?');
    if ($queryPosition !== false) {
        $path = substr($path, 0, $queryPosition);
    }

    $routeInfo = $dispatcher->dispatch($httpMethod, $path);

    $dispatcherResult = $routeInfo[0];
    
    if ($dispatcherResult == \FastRoute\Dispatcher::FOUND) {
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $params = InjectionParams::fromParams($vars);

        return new Tier($handler, $params, null);
    }
    else if ($dispatcherResult == \FastRoute\Dispatcher::NOT_FOUND) {
        //return new StandardHTTPResponse(404, $uri, "Route not found");
        return new Tier('serve404ErrorPage');
    }

    //TODO - need to embed allowedMethods....theoretically.
    return new Tier('serve405ErrorPage');
}