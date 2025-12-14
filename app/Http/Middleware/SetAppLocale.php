<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie as Cookies;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = request('locale');

        // App::setLocale($locale ?: config('app.locale'));

        // Cookies::queue('locale', $locale, 60 * 24 * 30); // Store for 30 days
        // App::setFallbackLocale(config('app.fallback_locale'));
        URL::defaults([
            'locale'=>$locale,
        ]);
        Route::current()->forgetParameter('locale');
        return $next($request);
    }
}
