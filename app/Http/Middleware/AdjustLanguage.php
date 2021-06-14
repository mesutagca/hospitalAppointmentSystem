<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class adjustLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!$request->session()->has('setLocale')) {
            session(['setLocale' => 'tr']);
        }
        App::setLocale(session('setLocale'));
        return $next($request);

    }

}
