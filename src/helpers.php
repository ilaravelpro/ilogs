<?php

function ilogs_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function ilogs($key = null, $default = null)
{
    return iconfig('ilogs' . ($key ? ".$key" : ''), $default);
}
