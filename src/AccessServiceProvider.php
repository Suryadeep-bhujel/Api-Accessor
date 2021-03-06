<?php

namespace Bhujel\SecretHeader;

use Bhujel\SecretHeader\Http\Commands\SetupApiAccessor;

use Bhujel\SecretHeader\Http\Helpers\EnvironmentUpdate;
use Bhujel\SecretHeader\Http\Middleware\AddExtraFieldToRequest;
use Bhujel\SecretHeader\Http\Middleware\ApiAccessMiddleware;
use Illuminate\Contracts\Http\Kernel as HttpKernelInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'accessor');
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupApiAccessor::class,
            ]);
        }

        EnvironmentUpdate::setEnv();
        
        $this->mergeConfigFrom(__DIR__ . '/config/api_accessor.php', 'access_config');
        $httpKernel = $this->app->make(HttpKernelInterface::class);

        $httpKernel->pushMiddleware(ApiAccessMiddleware::class);
        $httpKernel->pushMiddleware(AddExtraFieldToRequest::class);
        if (!file_exists(public_path('/api-accessor/css/styles.css'))) {
            $this->publishes([
                __DIR__ . '/public' => public_path('/api-accessor'),
            ], 'public');
            Artisan::call("vendor:publish --tag=public --force");
        }
        $this->publishes([
            __DIR__ . '/config/api_accessor.php' => config_path('api_accessor.php'),
        ], 'api-accessor');

    }
    public function register()
    {

    }
}
