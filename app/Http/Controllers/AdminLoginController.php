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
        // Check if user is authenticated with admin or tiket guard
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'tiket') {
                return redirect()->intended('admin/tiketing');
            }
        } elseif (Auth::guard('tiket')->check()) {
            $user = Auth::guard('tiket')->user();
            if ($user->role === 'tiket') {
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
        Auth::guard('tiket')->logout();
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

        // Find the user by email to determine the guard
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user) {
            $guard = ($user->role === 'admin') ? 'admin' : 'tiket';

            // Attempt to authenticate using the appropriate guard
            if (Auth::guard($guard)->attempt($credentials)) {
                $request->session()->regenerate();

                // Redirect based on role
                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'tiket') {
                    return redirect('admin/tiketing');
                } else {
                    // If role is neither admin nor tiket, logout and throw exception
                    Auth::guard($guard)->logout();
                    throw ValidationException::withMessages([
                        'email' => __('auth.failed'),
                    ]);
                }
            }
        }

        // If authentication failed, throw exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
