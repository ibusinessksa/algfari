<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetFilamentLocale
{
    public const SESSION_KEY = 'filament_locale';

    /**
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = ['ar', 'en'];

        $locale = $request->session()->get(self::SESSION_KEY, config('app.locale'));

        if (! is_string($locale) || ! in_array($locale, $allowed, true)) {
            $locale = config('app.locale');
        }

        if (! in_array($locale, $allowed, true)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
