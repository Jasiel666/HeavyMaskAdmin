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
            $response = Http::post('https://jasiel666.github.io/HeavyMaskAdmin/api/login', [
                'LoginName' => $request->LoginName,
                'LoginPassword' => $request->LoginPassword,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
              
                session(['admin_api_token' => $data['token']]);
                
                
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

                
                Auth::guard('admin')->login($admin);

              
                Log::info('Admin Login', [
                    'admin_id' => $admin->id,
                    'is_main_admin' => $admin->is_main_admin,
                    'is_authenticated' => Auth::guard('admin')->check()
                ]);
                
                return redirect()->route('productsInsert');
            }

         
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
           
            if (session()->has('admin_api_token')) {
                Http::withToken(session('admin_api_token'))
                    ->post('https://jasiel666.github.io/HeavyMaskAdmin/api/logout');
            }

            
            Auth::guard('admin')->logout();

          
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