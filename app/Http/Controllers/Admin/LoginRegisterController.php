<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    // Show the registration form
    public function register()
    {
        return view('auth.register');
    }

    // Handle the user registration request
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'admin'
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        // Regenerate session
        $request->session()->regenerate();

        // Redirect based on user type
        if ($request->user()->usertype == 'admin') {
            return redirect('admin/dashboard')->withSuccess('You have successfully registered & logged in as an Admin!');
        }

        return redirect()->intended(route('dashboard'))->withSuccess('You have successfully registered & logged in!');
    }

    // Show the login form
    public function login()
    {
        return view('auth.login');
    }

    // Handle the user login request
    public function authenticate(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            // Regenerate session
            $request->session()->regenerate();

            // Redirect based on user type
            if ($request->user()->usertype == 'admin') {
                return redirect()->intended('admin/dashboard')->withSuccess('Welcome Admin!');
            }

            return redirect()->intended(route('dashboard'))->withSuccess('You have successfully logged in!');
        }

        // If login fails, return with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle the user logout request
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login')->withSuccess('You have successfully logged out!');
    }
}
