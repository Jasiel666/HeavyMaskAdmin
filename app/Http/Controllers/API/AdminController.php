<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        try {
        
            
            $admins = Admin::all();
            return response()->json($admins);
        } catch (\Exception $e) {
          
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
    

    // Store a newly created admin in the database
    public function store(Request $request)
    {
        

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'is_main_admin' => 'required|boolean',
        ]);

        // Create a new admin record in the database
        $admin = Admin::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']), // Hash the password
            'is_main_admin' => $validatedData['is_main_admin'],
        ]);

        // Return a success message with the created admin data
        return response()->json([
            'message' => 'Admin created successfully!',
            'admin' => $admin
        ], 201); // 201 status code for created resource
    }

    // Show the details of a specific admin
    public function show($id)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id); // Retrieve the admin by ID
        return response()->json($admin); // Return admin data in JSON format
    }

    // Update the specified admin in the database
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6', // Password can be nullable if not changing
        'is_main_admin' => 'required|boolean',
    ]);

    // Retrieve the admin by ID
    $admin = Admin::findOrFail($id);

    // Update admin details
    $admin->name = $validatedData['name'];
    if (!empty($validatedData['password'])) {
        $admin->password = Hash::make($validatedData['password']); // Update password if provided
    }
    $admin->is_main_admin = $validatedData['is_main_admin'];
    $admin->save(); // Save the updated admin data

    // Return a success message with updated admin data
    return response()->json([
        'message' => 'Admin updated successfully!',
        'admin' => $admin
    ]);
}

    // Delete the specified admin from the database
    public function destroy($id)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id); // Retrieve the admin by ID
        $admin->delete(); // Delete the admin

        // Return a success message
        return response()->json([
            'message' => 'Admin deleted successfully!'
        ]);
    }
}
