<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * if current user is an admin
         * then restrict access to nornal user routes
         */
        if (auth()->user()->isAdmin()) {
            abort(404);
        }

        return $next($request);
    }
}
