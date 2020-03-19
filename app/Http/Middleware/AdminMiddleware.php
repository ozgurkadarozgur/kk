<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::guard('admin')->user() == null and $request->url() != route('admin.auth.login')) {
            return redirect()->route('admin.auth.login');
        }
        if (Auth::guard('admin')->user() and $request->url() == route('admin.auth.login')) {
            return redirect()->back();
        }
        return $next($request);
    }
}
