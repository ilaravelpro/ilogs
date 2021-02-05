<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/4/21, 11:36 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Controllers\API\v1;

use iLaravel\Core\iApp\Http\Controllers\API\Controller;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Index;
use iLaravel\Core\iApp\Http\Controllers\API\Methods\Controller\Show;


class ILogController extends Controller
{
    public $order_list = ['id', 'title'];

    use Index,
        Show,
        iLog\Rules,
        iLog\RequestData,
        iLog\Filters;
}
