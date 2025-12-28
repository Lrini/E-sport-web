<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     **/
    public function showLoginForm()
    {
        //auth()->check() digunakan untuk memeriksa apakah admin sudah login
        if (auth()->check()) {
            return redirect()->intended('/admin/dashboard');
        }
        return view('admin.login.login');
    }

    /**
     * Logout the admin user.
     */
    public function logout()
    {
        //season invalidate digunakan untuk menghapus session yang sedang aktif
        //season regenerateToken digunakan untuk menghindari serangan CSRF
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }

    /**
     * Handle a login request to the application.
     **/
    public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user using the 'web' guard or custom guard if configured
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Always redirect to admin dashboard after login
            return redirect('/admin/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
