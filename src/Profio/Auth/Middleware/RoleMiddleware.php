<?php

namespace Profio\Auth\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if (is_null($role)) {
            if (is_null($request->user()->role)) {
                return redirect('logout');
            } else {
                return $next($request);
            }
        }

        if (!$request->user()->inRole($role)) {
            if (is_null($request->user()->role)) {
                return redirect('logout');
            } else {
                return abort(403);
            }
        }

        return $next($request);
    }
}
