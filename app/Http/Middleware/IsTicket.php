<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsTicket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via ticket guard and has ticket role
        if (!auth('tiket')->check() || auth('tiket')->user()->role !== 'tiket') {
            abort(403); // Deny access if not ticket
        }

        return $next($request);
    }
}
