<?php
namespace Bhujel\SecretHeader\Http\Middleware;

use Bhujel\SecretHeader\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;

class ApiAccessMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->is(config('access_config.check_on') . '*')) {
            if (!$request->header(config('access_config.key_name'))) {
                abort(403, "Unauthorized Request.");
            }
            if ($request->header(config('access_config.key_name'))) {
                $check_key = AccessKey::where("key", $request->header(config('access_config.key_name')))->first();

                if ($check_key && $check_key->status == true) {
                    return $next($request);
                } else {
                    // return response()->json()
                    abort(403, "Access inactive or not exist.");
                }
            }
            abort(403, "Unauthorized Request.");
        } else {
            return $next($request);

        }
    }
}
