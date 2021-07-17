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
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                session()->flash('error', 'You are not authorized to perform this action.');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
