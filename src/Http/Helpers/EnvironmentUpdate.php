<?php

namespace  Bhujel\SecretHeader\Http\Helpers;

abstract class EnvironmentUpdate
{
    public static function setEnv()
    {
        if (!session()->get("environment") && !in_array(session()->get("environment"), ['test', 'live'])) {
            if (env("ENV_TYPE") && in_array(env("ENV_TYPE"), ['test', 'live'])) {
                session()->put("environment", env("ENV_TYPE"));
            } else {
                session()->put("environment", "live");
            }
        }

    }
    public static function updateEnv()
    {
        $current_env = session()->get('environment');
        if (!$current_env || !in_array($current_env, ['live', "test"])) {
            $current_env = env("ENV_TYPE", 'live');
            if (!in_array($current_env, ['live', "test"])) {
                $current_env = "live";
            }
        }
        if ($current_env == 'live') {
            $update_env = "test";
        } else if ($current_env == "test") {
            $update_env = "live";
        }
        session()->put('environment', $update_env);
        return true;
    }

}
