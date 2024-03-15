<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {
        if ( Auth::check() ) {
            if (method_exists(\Route::getCurrentRoute()->getActionMethod(), 'checkViewPermission')) {
                if (\Route::getCurrentRoute()->getController()->checkViewPermission() === false) {
                    abort(403);
                }
            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
