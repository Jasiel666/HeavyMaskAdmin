<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login'); // Adjust the view name as necessary
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'LoginName' => 'required',
            'LoginPassword' => 'required|min:8',
        ]);

        // Retrieve the admin by name
        $admin = Admin::where('name', $request->input('LoginName'))->first();

        // Check if admin exists and verify the password
        if ($admin && Hash::check($request->input('LoginPassword'), $admin->password)) {
            // Log in the admin using the 'admin' guard
            Auth::guard('admin')->login($admin);

            // Redirect to the intended page (change 'productsInsert' to your route)
            return redirect()->route('productsInsert');
        } else {
            // If credentials are invalid, redirect back with an error
            return redirect()->back()->withErrors(['LoginName' => 'Invalid credentials'])->withInput();
        }
    }

    // Handle logout request
    public function logout(Request $request)
    {
        // Log out the admin
        Auth::guard('admin')->logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('login');
    }
}
