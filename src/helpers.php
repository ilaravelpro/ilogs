<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

function ilogs_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function ilogs($key = null, $default = null)
{
    return iconfig('ilogs' . ($key ? ".$key" : ''), $default);
}
