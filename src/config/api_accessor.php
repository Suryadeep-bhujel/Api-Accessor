<?php
return [
    /*
     *
     *
     * @application database mysql or mongodb supported 
     *
     *
     */ 
    'database' => env("DB_CONNECTION", "mysql") ,
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

    "key_name" => "API-ACCESS-KEY",
    /*
     *
     *
     * @all the uri  prefix for  enable checking  key,
     *@array
     *
     */
    "check_on" => ["api/", "test/"],
    "check_test" => true,
    "extends_name" => "content",
    /*
     *
     *
     * @enable or disable this package for application
     *
     *
     */
    "enabled" => true, 

    /*
     *
     *
     * @All the middleware that you want to protect your access key dashboard  and action add below in array
     *@array
     *
     */
    
    "middleware" => ['web', 'auth'],
    /*
     *
     *
     * @use laravel caching to disable recurring query 
     *@ change  value as true  for use caching and false for direct querying to database
     *
     */
    "use_cache" => false,
    /*
     *
     *
     * @api key access from cached data
     *@caching time in hour
     *
     */
    
    "cache_duration" => 24, 
    // "primary_key" => ,

];
