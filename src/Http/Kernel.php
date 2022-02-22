<?php

namespace Bhujel\SecretHeader\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
         

        'web' => [
             
           \Bhujel\SecretHeader\Http\Middleware\ApiAccessMiddleware::class,
        ],
    ];

    
    // protected $routeMiddleware = [
    //     'auth' => \App\Http\Middleware\Authenticate::class,
        
    // ];
}
