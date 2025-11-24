<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user using the 'web' guard or custom guard if configured
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended admin dashboard or default page
            return redirect()->intended('/admin/dashboard');
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }
}
