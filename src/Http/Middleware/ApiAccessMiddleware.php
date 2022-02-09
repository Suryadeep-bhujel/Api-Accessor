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
        //   dd($check);
        if ($check) {
            if (!$request->header(config('access_config.key_name'))) {
                abort(403, "Unauthorized Request.");
            }
            if ($request->header(config('access_config.key_name'))) {
                // $keys = AccessKey::where("status", true)->get();
                // // dd($keys);
                // $valid = false;
                // foreach($keys as $keyItem){
                //     // if(Hash::check($,   $keyItem->key)){

                //     // }

                // }
                $check_key = AccessKey::where("key", $request->header(config('access_config.key_name')))
                    ->where('status', true)
                    ->first();

                if ($check_key) {
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
