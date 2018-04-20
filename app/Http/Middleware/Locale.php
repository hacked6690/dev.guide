<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

use Illuminate\Support\Facades\View;

class Locale
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
        if (!Session::has('locale'))
        {
            Session::put('locale', Config::get('app.fallback_locale'));
        }

        // share view variables ;
        View::share('layout', \Layout::translated(Session::get('locale')));

        app()->setLocale(Session::get('locale'));

        return $next($request);
    }
}
