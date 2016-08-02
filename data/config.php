<?php

// This is a sample configuration file
use TierJigSkeleton\Config;
use Jig\Jig;
use Room11\Caching\LastModifiedStrategy;

$socketDir = '/var/run/php-fpm';

$default = [
    'app_name' => 'tierjigskeleton',
    'app_sitename' => 'tierjig',
    'nginx_sendFile' => 'off',
];

$live = [];
$dev = [];

$live['nginx_sendFile'] = 'on';

// What cache setting to use for assets
$live[Config::CACHING_SETTING] = LastModifiedStrategy::CACHING_TIME;;
$dev[Config::CACHING_SETTING] = LastModifiedStrategy::CACHING_REVALIDATE;

// Whether JS/CSS should be served packed together.
$live[Config::SCRIPT_PACKING] = true;
$dev[Config::SCRIPT_PACKING] = false;

// Whether to recompile Jig templates 
$dev[Config::JIG_COMPILE_CHECK] = Jig::COMPILE_CHECK_MTIME;
$live[Config::JIG_COMPILE_CHECK] = Jig::COMPILE_CHECK_EXISTS;

$centos = [
    'nginx_log_directory' => '/var/log/nginx',
    'nginx_root_directory' => '/usr/share/nginx',
    'nginx_conf_directory' => '/etc/nginx',
    'nginx_run_directory ' => '/var/run',
    'nginx_user' => 'nginx',
    'nginx_sendFile' => 'on',

    'app_root_directory' => dirname(__DIR__),

    'phpfpm_www_maxmemory' => '16M',
    'phpfpm_group' => 'www-data',
    'phpfpm_socket_directory' => '/var/run/php-fpm',
    'phpfpm_conf_directory' => '/etc/php-fpm.d',
    'phpfpm_pid_directory' => '/var/run/php-fpm',

    'php_conf_directory' => '/etc/php',
    'php_log_directory' => '/var/log/php',
    'php_errorlog_directory' => '/var/log/php',
    'php_session_directory' => '/var/lib/php/session',
    
    'phpfpm_fullsocketpath' => $socketDir."/php-fpm-blog-".basename(dirname(__DIR__)).".sock",
    
];

// Duplicate the environment for local dev.
$centos_guest = $centos;

