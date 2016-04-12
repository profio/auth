<?php

namespace Profio\Auth\Middleware;

use Closure;

class Authorize
{
    /**
     * Path based permission.
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd($request->user());
        if (!$request->user()->can($request->path())) {
            return redirect('/');
        }

        return $next($request);
    }
}
