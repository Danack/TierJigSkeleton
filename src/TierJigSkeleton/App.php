<?php

namespace TierJigSkeleton;

use ASM\Session;
use ASM\SessionConfig;
use ASM\SessionManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection as DBConnection;
use FastRoute\Dispatcher;
use Jig\Jig;
use Jig\JigConfig;
use Predis\Client as RedisClient;
use Room11\HTTP\Response;
use Room11\Caching\LastModifiedStrategy;
use Room11\HTTP\HeadersSet;
use Tier\TierApp;
use Tier\TierException;
use TierJigSkeleton\Config;

class App
{
    /**
     * @return JigConfig
     */
    public static function createJigConfig(
        Config $config,
        \Jig\JigTemplatePath $templatePath,
        \Jig\JigCompilePath $compilePath
    ) {
        $jigConfig = new JigConfig(
            $templatePath,
            $compilePath,
            $config->getKey(Config::JIG_COMPILE_CHECK),
            'tpl'
        );

        return $jigConfig;
    }

    public static function routesFunction(\FastRoute\RouteCollector $r)
    {
        $r->addRoute('GET', '/', ['TierJigSkeleton\Controller\Basic', 'index']);
        $r->addRoute('GET', '/notepad', ['TierJigSkeleton\Controller\Basic', 'notepad']);
        $r->addRoute('GET', '/login', ['TierJigSkeleton\Controller\Basic', 'login']);
        $r->addRoute('POST', '/login', ['TierJigSkeleton\Controller\Basic', 'loginProcess']);
        $r->addRoute('POST', '/testBadMethod', ['TierJigSkeleton\Controller\Index', 'testBadMethod']);
    }

    /**
     * @param Jig $jig
     * @param $injector
     */
    public static function prepareJig(Jig $jig, $injector)
    {
        // nothing to do currently.
        // This is where default plugins would be added.
    }

    /**
     * @return RedisClient
     */
    public static function createRedisClient()
    {
        $redisParameters = array(
            "scheme" => "tcp",
            "host" => '127.0.0.1',
            "port" => 6379
        );

        $redisOptions = array(
            'profile' => '2.6'
        );

        $redisClient = new RedisClient($redisParameters, $redisOptions);

        return $redisClient;
    }

    /**
     * @param \ASM\Driver $driver
     * @return Session
     */
    public static function createSession(\ASM\Driver $driver)
    {
        $sessionConfig = new SessionConfig(
            'SessionTest',
            1000,
            10
        );

        $sessionManager = new SessionManager(
            $sessionConfig,
            $driver
        );

        $session = $sessionManager->createSession($_COOKIE);

        return $session;
    }


    public static function createCaching(Config $config)
    {
        $cacheSetting = $config->getKey(Config::CACHING_SETTING);

        switch ($cacheSetting) {
            case LastModifiedStrategy::CACHING_DISABLED: {
                return new \Room11\Caching\LastModified\Disabled();
            }
            case LastModifiedStrategy::CACHING_REVALIDATE: {
                return new \Room11\Caching\LastModified\Revalidate(3600 * 2, 3600);
            }
            case LastModifiedStrategy::CACHING_TIME: {
                return new \Room11\Caching\LastModified\Time(3600 * 10, 3600);
            }
            default: {
                throw new TierException("Unknown caching setting '$cacheSetting'.");
            }
        }
    }

    public static function createScriptInclude(
        Config $config,
        \ScriptHelper\ScriptURLGenerator $scriptURLGenerator
    ) {
        $packScript = $config->getKey(Config::SCRIPT_PACKING);

        if ($packScript) {
            return new \ScriptHelper\ScriptInclude\ScriptIncludePacked($scriptURLGenerator);
        }
        else {
            return new \ScriptHelper\ScriptInclude\ScriptIncludeIndividual($scriptURLGenerator);
        }
    }

    /**
     * @param Session $session
     * @param HeadersSet $headerSet
     * @return int
     */
    public static function addSessionHeader(Session $session, HeadersSet $headerSet)
    {
        $headers = $session->getHeaders(\ASM\SessionManager::CACHE_PRIVATE);
        foreach ($headers as $key => $value) {
            $headerSet->addHeader($key, $value);
        }

        return TierApp::PROCESS_CONTINUE;
    }

    public static function createDispatcher()
    {
        $dispatcher = \FastRoute\simpleDispatcher(['TierJigSkeleton\App', 'routesFunction']);

        return $dispatcher;
    }

    /**
     * @return DBConnection
     * @throws \Doctrine\DBAL\DBALException
     */
    public function createDBConnection()
    {
        $conn = DriverManager::getConnection(['pdo' => new \PDO('sqlite:testing.sqlite')]);
        
        return $conn;
    }

    public static function createServerRequest()
    {
        $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        return $request;
    }
}
