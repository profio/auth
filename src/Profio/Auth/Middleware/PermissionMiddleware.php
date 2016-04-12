<?php

namespace Profio\Auth\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        // if (!$request->user()->can($permission)) {
        //     return redirect('/');
        // }

        return $next($request);
    }
}
