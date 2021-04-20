<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $availablelocales=['en','am'];
        $locale=session('APP_LOCALE');
        $locale=in_array($locale, $availablelocales) ? $locale: config('app.locale');
        app()->setlocale($locale);
        return $next($request);
    }
}