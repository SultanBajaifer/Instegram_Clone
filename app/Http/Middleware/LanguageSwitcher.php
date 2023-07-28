<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Session;
use View;

class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // set session variables
        // if ($request->hasSession()) {
        // session(['language' => 'en'], 'en');
        $lang = session()->get('language');
        // }
        // dd(session()->get('language', 'en'));
        if (Auth::user() != null) {
            App::setLocale(Auth::user()->language);
            if (Auth::user()->language == 'ar') {
                View::share('rtl', 'true');
            }
        } else if (isset($lang)) {
            // dd($lang);
            App::setLocale($lang);
            if ($lang == 'ar') {
                View::share('rtl', 'true');
            }
        }
        return $next($request);
    }
}