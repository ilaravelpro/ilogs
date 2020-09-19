<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/17/20, 2:23 PM
 * Copyright (c) 2020. Powered by iamir.net
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
