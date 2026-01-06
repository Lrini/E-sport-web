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
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'tiket') {
                return redirect()->intended('admin/tiketing');
            }
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

        // Attempt to authenticate the user using the admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            $request->session()->regenerate();

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'tiket') {
                return redirect('admin/tiketing');
            } else {
                // If role is neither admin nor ticket, logout and throw exception
                Auth::guard('admin')->logout();
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        }

        // If authentication failed, throw exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
