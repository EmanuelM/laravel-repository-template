<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageSwitcher
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
        if(!empty($request->lang)) {
            $app_langs = explode(",", config('app.languages'));

            if (in_array($request->lang, $app_langs)) {
                app()->setLocale($request->lang);
            }
        }

        return $next($request);
    }
}
