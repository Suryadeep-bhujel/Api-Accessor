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
     * @Key name to send while requesting api  access from third party app
     *
     *
     */

    "key_name" => "API_ACCESS_KEY",
    "check_on" => ["api/", "test/"],
    "check_test" => true,
   
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
