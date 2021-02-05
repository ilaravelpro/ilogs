<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/24/21, 9:08 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

Route::namespace('v1')->prefix('v1')->middleware('auth:api')->group(function () {
    Route::apiResource('logs', 'ILogController', ['as' => 'api','except' => ['store','update','destroy']]);
});
