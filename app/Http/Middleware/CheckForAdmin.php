<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForAdmin
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
         * If Current user is Admin
         * give access to all admin routes
         */
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }

        abort(404);
    }
}
