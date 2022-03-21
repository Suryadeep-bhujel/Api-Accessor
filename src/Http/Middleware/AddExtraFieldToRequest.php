<?php

namespace Bhujel\SecretHeader\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddExtraFieldToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->request->add(['environment' => env('ENV_TYPE') && in_array(env('ENV_TYPE'), ['test', 'live'])   ? env("ENV_TYPE") : 'test']);
        // dd($request->all());
        return $next($request);
    }
}
