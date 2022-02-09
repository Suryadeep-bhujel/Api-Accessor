<?php 
namespace Bhujel\SecretHeader\Http\Middleware;

use Bhujel\SecretHeader\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;
class ApiAccessMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        // dd($request);
        // dd($request->route()->getPrefix());
        if($request->is(config('access_config.check_on').'*')){
            // dd('hello bro', $request->all());
            if(!$request->header(config('access_config.key_name'))){
                abort(403, "Unauthorized Request.");
            }
            if($request->header(config('access_config.key_name'))){
                    $check_key = AccessKey::where("key", $request->header(config('access_config.key_name')))->first();
                if($check_key && $check_key->status == true){
                    return $next($request);
                }else {
                    // return response()->json()
                    abort(403, "Access inactive or not exist.");
                }
                // dd($check_key);
            }
            
            // dd(config('access_config.key_name'));
            // dd($request->header(config('access_config.key_name')));
            
            abort(403, "Unauthorized Request.");
        }else {
            return $next($request);

        }
    }
}