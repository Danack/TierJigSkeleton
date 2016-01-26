<?php

function getAppEnv()
{
    static $env = [
        'jig_compilecheck' => 'COMPILE_CHECK_MTIME',
        'caching_setting' => 'caching.revalidate',
    ];

    return $env;
}
