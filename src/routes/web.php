<?php

use Bhujel\SecretHeader\Http\Controllers\AccesskeyController;
use Bhujel\SecretHeader\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// dd(config('access_config.middleware'));
// dd(config('access_config.extends_name'));
Route::group([ ], function ($router) {
    $router->get('/access-key/dashbaord', [DashboardController::class, "dashboard"])->name('accesskey.dashboard');
    $router->resource('access_keys', AccesskeyController::class);
});