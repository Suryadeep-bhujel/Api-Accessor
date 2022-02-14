<?php
namespace Bhujel\SecretHeader\Http\Middleware;

use Bhujel\SecretHeader\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;

class ApiAccessMiddleware
{

    public function handle(Request $request, Closure $next)
    {

       
        if(config("api_accessor.enabled") == true){ 
            $check = false;
            foreach (config('api_accessor.check_on') as $prefix) {
                if ($request->is($prefix . '*')) {
                    $check = true;
                    break;
                }
            }
            if ($check) {
                if (!$request->header(config('api_accessor.key_name'))) {
                    abort(403, "Unauthorized Request. Required Header does not exists on request.");
                }
                if ($request->header(config('api_accessor.key_name'))) {
                    if (config("api_accessor.use_cache")) {
                        $check_key = cache()->remember($request->header(config('api_accessor.key_name')), config('api_accessor.cache_duration'), function () use ($request) {
                            return AccessKey::where("key", $request->header(config('api_accessor.key_name')))
                                ->where('status', true)
                                ->first();
                        });
                    } else {
                        $check_key = AccessKey::where("key", $request->header(config('api_accessor.key_name')))
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
            } 
        }

        return $next($request);
    }
}
