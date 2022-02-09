<?php

namespace Bhujel\SecretHeader;

use Bhujel\SecretHeader\Http\Middleware\ApiAccessMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Contracts\Http\Kernel as HttpKernelInterface;
use Illuminate\Support\Facades\Artisan;

class AccessServiceProvider extends ServiceProvider
{
    public function boot( ){
        // dd('hello  from test');
        // echo 'catched';
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'accessor');
        // $this->loadViewComponentsAs('courier', [
        //     Alert::class,
        //     Button::class,
        // ]);
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'access_config');
        $httpKernel = $this->app->make(HttpKernelInterface::class);
     
        $httpKernel->pushMiddleware(  ApiAccessMiddleware::class);
        if(!file_exists(public_path('/api-accessor/css/styles.css'))){
            // dd('helosdfsdf');
            $this->publishes([
                __DIR__.'/public' => public_path('/api-accessor'),
            ], 'public');

        }
        Artisan::call("vendor:publish --tag=public --force");
        // dd(app('router'));
    }
    public function register()
    {
        // dd('hello  from test');
        // app('router')->pushMiddlewareToGroup('web',  ApiAccessMiddleware::class);
        // dd(app('router'));
        
    }
}
