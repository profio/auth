<?php

namespace Profio\Auth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if (env('BYPASS_ACCESS') == 1) {
            return $next($request);
        }

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        if ($this->auth->user()->can($request->route()->getName())) {
            return $next($request);
        } else {
            flash()->error('Anda tidak mempunyai akses untuk membuka halaman tersebut.');

            return redirect('/');
        }
    }
}
