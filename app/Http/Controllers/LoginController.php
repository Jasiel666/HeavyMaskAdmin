<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'LoginName' => 'required',
            'LoginPassword' => 'required|min:8',
        ]);

        try {
            $response = Http::post('http://127.0.0.1:8000/api/login', [
                'LoginName' => $request->LoginName,
                'LoginPassword' => $request->LoginPassword,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Store token in session
                session(['admin_api_token' => $data['token']]);
                
                // Create or update admin in local database
                $adminData = $data['admin'];
                
                $admin = Admin::updateOrCreate(
                    ['name' => $adminData['name']],
                    [
                        'is_main_admin' => $adminData['is_main_admin'],
                        'password' => $adminData['password'] ?? bcrypt($request->LoginPassword),
                        'created_at' => $adminData['created_at'] ?? now(),
                        'updated_at' => $adminData['updated_at'] ?? now(),
                    ]
                );

                // Login the admin using Laravel's authentication
                Auth::guard('admin')->login($admin);

                // For debugging
                Log::info('Admin Login', [
                    'admin_id' => $admin->id,
                    'is_main_admin' => $admin->is_main_admin,
                    'is_authenticated' => Auth::guard('admin')->check()
                ]);
                
                return redirect()->route('productsInsert');
            }

            // For debugging failed response
            Log::error('Login Failed Response', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            return redirect()
                ->back()
                ->withErrors(['LoginName' => 'Invalid credentials'])
                ->withInput();

        } catch (\Exception $e) {
            // Log the error
            Log::error('Login Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Login failed: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            // Call API logout endpoint if token exists
            if (session()->has('admin_api_token')) {
                Http::withToken(session('admin_api_token'))
                    ->post('http://127.0.0.1:8000/api/logout');
            }

            // Logout from Laravel's authentication
            Auth::guard('admin')->logout();

            // Clear local session
            session()->forget(['admin_api_token', 'admin']);
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('login');
        } catch (\Exception $e) {
            Log::error('Logout Error', [
                'message' => $e->getMessage()
            ]);
            return redirect('login');
        }
    }

    // Add this debug method to check authentication status
    public function checkAuthStatus()
    {
        return response()->json([
            'is_logged_in' => Auth::guard('admin')->check(),
            'user' => Auth::guard('admin')->user(),
            'session_token' => session('admin_api_token'),
            'guard' => Auth::getDefaultDriver(),
        ]);
    }
}