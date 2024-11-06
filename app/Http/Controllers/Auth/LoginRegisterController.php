<?php

namespace App\Http\Controllers\Auth; // Namespace comes first

use App\Http\Controllers\Controller; // Import the base controller
use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\Hash; // Import Hash facade

class LoginRegisterController extends Controller // The class extends Controller
{
    // Method to show the registration form
    public function register()
    {
        return view('auth.register'); // Return the registration view
    }

    // Method to handle the registration logic
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard or another route
        return redirect()->route('admin.dashboard'); // Change this to your desired route
    }

    // Method to show the login form
    public function login()
    {
        return view('auth.login'); // Return the login view
    }

    // Method to handle the authentication logic
    public function authenticate(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to the dashboard or another route
            return redirect()->route('admin.dashboard'); // Change this to your desired route
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Method to handle user logout
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect('/'); // Redirect after logout
    }
}
