<?php

use Bhujel\SecretHeader\Http\Controllers\AccesskeyController;
use Bhujel\SecretHeader\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => 'dashboard'], function ($router) {

    $router->get('/accessor', [DashboardController::class, "dashboard"])->name('accesskey.dashboard');
    $router->resource('access_keys', AccesskeyController::class);
});
