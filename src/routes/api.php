<?php

Route::namespace('v1')->prefix('v1')->middleware('auth:api')->group(function () {
    Route::apiResource('logs', 'ILogController', ['as' => 'api','except' => ['store','update','destroy']]);
});
