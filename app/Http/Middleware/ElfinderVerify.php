<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Auth;

use Illuminate\Support\Facades\View;

class ElfinderVerify
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

        if(!Auth::check())
        {
            return redirect('/login');

        } else if(!Auth::user()->authorized('elfinder')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
