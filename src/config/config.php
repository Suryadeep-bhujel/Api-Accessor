<?php
return [
    /*
     *
     *
     * @application database mysql or mongodb supported 
     *
     *
     */ 
    'database' => env("DB_CONNECTION", "mongodb") ,
    /*
     *
     *
     * @Route prefix for your laravel aplication to manage your api access key
     *
     *
     */
    'main_dashboard_route' => "dashboard",
    /*
     *
     *
     * @Key name to send while requesting api  access from third party app
     *
     *
     */

    "key_name" => "API_ACCESS_KEY",
    "check_on" => "api/",
    "check_test" => true,
    "extends" => "welcome",
    "extends_name" => "content",
    /*
     *
     *
     * @All the middleware that you want to protect your access key dashboard  and action add below in array
     *@array
     *
     */
    "middleware" => ['web'],
    // "primary_key" => ,

];
