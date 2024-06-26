<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (config('templatecookie.default_language')) {
            app()->setLocale(config('templatecookie.default_language'));
        }
        if (session('locale')) {
            app()->setLocale(session('locale'));
        }
        if (! session('locale') && ! config('templatecookie.default_language')) {
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
