<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FacilityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('facility')->user() == null and $request->url() != route('facility.auth.login')) {
            return redirect()->route('facility.auth.login');
        }
        if (Auth::guard('facility')->user() and $request->url() == route('facility.auth.login')) {
            return redirect()->back();
        }
        return $next($request);
    }
}
