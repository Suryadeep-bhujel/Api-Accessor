<?php
namespace Bhujel\SecretHeader\Http\Middleware;

use Bhujel\SecretHeader\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;

class ApiAccessMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        $check = false;
        foreach (config('access_config.check_on') as $prefix) {
            if ($request->is($prefix . '*')) {
                $check = true;
                break;
            }
        }

        if ($check) {
            if (!$request->header(config('access_config.key_name'))) {
                abort(403, "Unauthorized Request.");
            }
            if ($request->header(config('access_config.key_name'))) {
                if (config("access_config.use_cache")) {
                    $check_key = cache()->remember($request->header(config('access_config.key_name')), config('access_config.cache_duration'), function () use ($request) {
                        return AccessKey::where("key", $request->header(config('access_config.key_name')))
                            ->where('status', true)
                            ->first();
                    });
                } else {
                    $check_key = AccessKey::where("key", $request->header(config('access_config.key_name')))
                        ->where('status', true)
                        ->first();
                }

                if ($check_key) {
                    return $next($request);
                } else {

                    abort(403, "Access inactive or not exist.");
                }
            }
            abort(403, "Unauthorized Request.");
        } else {
            return $next($request);
        }
    }
}
