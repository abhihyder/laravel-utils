<?php

namespace Hyder\LaravelUtils;

use Hyder\LaravelUtils\Services\EnumFacadeService;
use Illuminate\Support\ServiceProvider;

class LaravelUtilsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-utils-enum-facade', function ($app) {
            return $app->make(EnumFacadeService::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Configure the package 
        $this->mergeConfigFrom(__DIR__ . '/config/laravel-utils.php', 'laravel-utils');

        $this->publishes([
            __DIR__ . '/config/laravel-utils.php' => config_path('laravel-utils.php'),
        ], 'laravel-utils-config');
    }
}
