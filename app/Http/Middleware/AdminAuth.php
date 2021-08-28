<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate as Middleware;

class AdminAuth extends Middleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards): mixed
    {
        $this->authenticate($request, $guards);
        if ($request->user() === null) {
            return route('login');
        }
        if ($request->user()->hasRole('Admin')) {
            return $next($request);
        }
        return response("You dont have permission", 403);
    }
}
