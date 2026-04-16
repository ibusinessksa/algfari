<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language', 'ar');
        $locale = in_array($locale, ['ar', 'en']) ? $locale : 'ar';
        app()->setLocale($locale);

        return $next($request);
    }
}
