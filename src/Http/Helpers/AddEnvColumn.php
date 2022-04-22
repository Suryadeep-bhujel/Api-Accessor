<?php
namespace Bhujel\SecretHeader\Http\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class AddEnvColumn
{
    public static function checkForColumn()
    {

        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tablename = "Tables_in_" . env('DB_DATABASE');
            $tablename = $table->$tablename;
            if (!Schema::hasColumn($tablename, 'environment')) {
                Schema::table($tablename, function (Blueprint $table) {
                    $table->string("environment")->default("live");
                });
            }
        }
        self::setEnv("IS_API_ENV", "true #DO NOT remove this key value for api_accessor ");

        if (!env("ENV_TYPE") || empty(env("ENV_TYPE"))) {
            self::setEnv("ENV_TYPE", "live  #api_accessor environment");
        }
    }
    public static function setEnv($envKey, $envValue)
    {
        $path = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($envKey), '/');
        //update value of existing key
        file_put_contents($path, preg_replace(
            "/^{$envKey}{$escaped}/m",
            "{$envKey}={$envValue}",
            file_get_contents($path)
        ));
        //if key not exist append key=value to end of file
        $fp = fopen($path, "r");
        $content = fread($fp, filesize($path));
        fclose($fp);
        if (strpos($content, $envKey . '=' . $envValue) == false && strpos($content, $envKey . '=' . '\"' . $envValue . '\"') == false) {
            file_put_contents($path, $content . "\n" . $envKey . '=' . $envValue);
        }
    }

}
