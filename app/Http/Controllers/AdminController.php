<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
   

    public function create()
    {
     return view('createAdmin');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);  
        return view('editAdmin', compact('admin'));
    }
    
    public function index()
    {
        try {
            $response = Http::withToken(session('admin_api_token'))
            ->get(config('app.api_url') . '/admins');

        if ($response->successful()) {
            return view('AdminsGrid', [
                'admins' => $response->json()['data'] ?? [],
                'isMainAdmin' => Auth::guard('admin')->check() && Auth::guard('admin')->user()->is_main_admin
            ]);
        }
            // Log the response for debugging
            Log::info('API Response:', [
                'status' => $response->status(),
                'body' => $response->json(),
                'headers' => $response->headers()
            ]);
            
            

            if ($response->successful()) {
                return view('AdminsGrid', [
                    'admins' => $response->json()['data'] ?? []
                ]);
            }

            // If not successful, log the error
            Log::error('API Error:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

           

            return redirect()->back()->withErrors('Failed to fetch admins data');
        } catch (\Exception $e) {
            Log::error('Admin fetch error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error fetching admins data');
        }
    }

    public function store(Request $request) {
        try {
            // Validate the new admin data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'is_main_admin' => 'required|boolean',
            ]);
    
            // Get the token from session using your key 'admin_api_token'
            $token = session('admin_api_token');
            
            if (!$token) {
                return redirect()->route('login')
                    ->withErrors('Session expired. Please login again.');
            }
    
            // Create new admin using the token
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ])->post('http://127.0.0.1:8000/api/admins', $validatedData);
    
            if ($response->successful()) {
                return redirect()->route('AdminsTable')
                    ->with('success', 'Admin created successfully!');
            }
    
            // Handle specific error cases
            if ($response->status() === 401) {
                // If token is invalid/expired
                return redirect()->route('login')
                    ->withErrors('Session expired. Please login again.');
            }
    
            return redirect()->back()
                ->withErrors($response->json()['message'] ?? 'Failed to create admin.')
                ->withInput();
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors('An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }
   
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'is_main_admin' => 'required|boolean',
        ]);

        try {
            $response = Http::withToken(session('admin_api_token'))
                ->put("http://127.0.0.1:8000/api/admins/{$id}", $validatedData);

            if ($response->successful()) {
                return redirect()->route('AdminsTable')
                    ->with('success', 'Admin updated successfully!');
            }

            return redirect()->back()
                ->withErrors(['error' => $response->json()['message'] ?? 'Update failed']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update admin']);
        }
    }
    public function destroy($id)
{
    $token = session('admin_api_token'); 

    if (!$token) {
        return redirect()->route('login')->withErrors('Session expired. Please log in again.');
    }

    $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/admins/{$id}");

    Log::info('API Response:', [
        'status' => $response->status(),
        'body' => $response->body(),
    ]);

   
    if ($response->successful()) {
        return redirect()->route('AdminsTable')->with('success', 'Admin deleted successfully!');
    } elseif ($response->status() === 403) {
        return redirect()->back()->withErrors('Unauthorized action. You are not allowed to delete admins.');
    }

    Log::error('Failed to delete admin', ['status' => $response->status(), 'body' => $response->body()]);
    return redirect()->back()->withErrors('Failed to delete admin. Please try again later.');
}
    
}
