<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                
                // Store admin data if needed
                session(['admin' => $data['admin']]);

                return redirect()->route('productsInsert');
            }

            return redirect()
                ->back()
                ->withErrors(['LoginName' => 'Invalid credentials'])
                ->withInput();

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Login failed'])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            // Call API logout endpoint
            Http::withToken(session('admin_api_token'))
                ->post('http://127.0.0.1:8000/api/logout');

            // Clear local session
            session()->forget(['admin_api_token', 'admin']);
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('login');
        } catch (\Exception $e) {
            return redirect('login');
        }
    }
}