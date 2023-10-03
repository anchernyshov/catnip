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

    public function handle($request, Closure $next)
    {
        $permission = null;
        $controller_class_name = \Route::getRoutes()->match($request)->action['controller'];
        
        if (class_exists($controller_class_name)) {
            $permission = null;
            if (defined("$controller_class_name::VIEW_PERMISSION")) {
                $permission = $controller_class_name::VIEW_PERMISSION;
            }
        }

        if ( Auth::check() ) {
            if ($permission === null) {
                return $next($request);
            } else {
                if (Auth::user()->checkPermission($permission)) {
                    return $next($request);
                } else {
                    abort(403);
                }
            }
        } else {
            return redirect()->route('login');
        } 
    }
}
