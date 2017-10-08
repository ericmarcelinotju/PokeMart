<?php

namespace App\Http\Middleware;

use Closure;
use App\Custom\CustomAuth as Auth;

class AuthorizeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (!Auth::hasRole($role)) {
                return response('Unauthorized.', 401);
            }
        }else{
            return redirect()->guest('login');
        }
        return $next($request);
    }
}
