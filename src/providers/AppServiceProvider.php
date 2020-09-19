<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 9/17/20, 6:15 PM
 * Copyright (c) 2020. Powered by iamir.net
 */

namespace iLaravel\iLogs\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(ilogs_path('config/ilogs.php'), 'ilaravel.ilogs');

        if($this->app->runningInConsole())
        {
            if (ilogs('database.migrations.include', true)) $this->loadMigrationsFrom(ilogs_path('database/migrations'));
        }
        $this->registerRoutes();
    }

    public function register()
    {
        parent::register();
    }

    public function registerRoutes() {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('api', \iLaravel\iLogs\iApp\Http\Middleware\iResponse::class);
        $router->pushMiddlewareToGroup('web', \iLaravel\iLogs\iApp\Http\Middleware\iResponse::class);
    }
}
