<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
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
        if (auth()->user()) {
            $lang = auth()->user()->language ?? config('app.locale');
        } else {
            $lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';
            $acceptedLang = ['es', 'en'];
            $lang = in_array($lang, $acceptedLang) ? $lang : config('app.locale');
        }

        App::setLocale($lang);

        return $next($request);
    }
}
