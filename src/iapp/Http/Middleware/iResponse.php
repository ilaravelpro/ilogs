<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/27/21, 1:00 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Middleware;

use Closure;
use iLaravel\iLogs\Vendor\Submit;

class iResponse
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        return $response;
    }

    public function terminate($request, $response)
    {
        if ($response instanceof \Illuminate\Http\JsonResponse && $response->getData()->is_ok)
            Submit::Log($request, $response);
    }
}
