<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class StaffCheck
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
        if (Auth::user()->roles()->whereIn('title', ['Staff','Coordinator','Guest'])->exists())
        {
            return $next($request);
        }
        abort(403, 'Access denied');
    }
}
