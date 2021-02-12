<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && ($request->user()->role == 'Admin' || $request->user()->role == 'SuperAdmin') ) {

            return $next($request);
        } else {

            return back()->with('error','you are not authorized to access!');
        }
    }
}
