<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // fungsi ini mengarahkan user yang belum login ke halaman login admin
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login.form');
        }
    }
}
