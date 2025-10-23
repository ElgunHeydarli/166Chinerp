<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $langs = ['az', 'en', 'zh'];
        $current_locale = Session::get('locale', 'az');
        if (in_array($current_locale, $langs)) {
            app()->setLocale($current_locale);
        } else {
            app()->setLocale('az');
        }
        return $next($request);
    }
}
