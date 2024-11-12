<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Admin;
class AdminController extends Controller
{
    public function index()
    {
        // Call the API to fetch admin data
        $response = Http::withToken('3|4PDvp0tn4cm0XvVCl75EZXvY0Z2H0p2egqIKfKCj62cf4afb')->get('http://127.0.0.1:8000/api/admins');
        if ($response->successful()) {
            $admins = $response->json();
            return view('AdminsGrid', compact('admins'));
        }

        return redirect()->back()->withErrors('Failed to load admins.');
    }

    public function create()
    {
    return view('createAdmin');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);  // Fetch the admin based on the id
        return view('editAdmin', compact('admin'));
    }
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'is_main_admin' => 'required|boolean',
        ]);
    
        // Send data to API for storage using POST request
        $response = Http::withToken('3|4PDvp0tn4cm0XvVCl75EZXvY0Z2H0p2egqIKfKCj62cf4afb')
                        ->post('http://127.0.0.1:8000/api/admins', $validatedData);
    
        if ($response->successful()) {
            return redirect()->route('AdminsTable')->with('success', 'Admin created successfully!');
        }
    
        // If the request failed, dump the response for debugging
        dd($response);
    
        return redirect()->back()->withErrors('Failed to create admin.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'is_main_admin' => 'required|boolean',
        ]);


        $response = Http::withToken('3|4PDvp0tn4cm0XvVCl75EZXvY0Z2H0p2egqIKfKCj62cf4afb') // Replace with dynamic token
    ->put("http://127.0.0.1:8000/api/admins/{$id}", $validatedData);

        if ($response->successful()) {
            return redirect()->route('AdminsTable')->with('success', 'Admin updated successfully!');
        }

        return redirect()->back()->withErrors('Failed to update admin.');
    }

    public function destroy($id)
    {
        // Delete admin via API
        $response = Http::delete("http://127.0.0.1:8000/api/admins/{$id}");

        if ($response->successful()) {
            return redirect()->route('AdminsTable')->with('success', 'Admin deleted successfully!');
        }

        return redirect()->back()->withErrors('Failed to delete admin.');
    }
}
