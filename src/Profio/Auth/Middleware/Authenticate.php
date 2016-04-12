<?php

namespace Profio\Auth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthenticated.', 401);
            } else {
                return redirect('login');
            }
        } else {
            $user = $this->auth->user();
            $role = $this->auth->user()->role;

            if (is_null($role)) {
                return redirect('login')->withMessage('Your role has been reset. Please try to login again.');
            }

            if (!$user->hasRole($role->name)) {
                return redirect('login')->withMessage('Your role has been reset. Please try to login again.');
            }
        }

        return $next($request);
    }
}
