<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        try {
            $admins = Admin::select('id', 'name', 'is_main_admin', 'created_at', 'updated_at')
                ->get();

            return response()->json([
                'data' => $admins,
                'message' => 'Admins retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Admin fetch error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to retrieve admins',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    // Store a newly created admin in the database
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'is_main_admin' => 'required|boolean',
            ]);

            // Check if admin with same name already exists
            if (Admin::where('name', $validatedData['name'])->exists()) {
                return response()->json([
                    'message' => 'Admin with this name already exists',
                    'errors' => ['name' => ['Name is already taken']]
                ], 422);
            }

            // Create the admin
            $admin = Admin::create([
                'name' => $validatedData['name'],
                'password' => Hash::make($validatedData['password']),
                'is_main_admin' => $validatedData['is_main_admin'],
            ]);

            // Log the successful creation
            Log::info('Admin created successfully', ['admin_id' => $admin->id]);

            return response()->json([
                'message' => 'Admin created successfully!',
                'admin' => $admin->makeVisible(['created_at', 'updated_at'])->toArray()
            ], 201);

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error while creating admin', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            
            return response()->json([
                'message' => 'Database error occurred',
                'error' => 'Could not create admin account'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Unexpected error while creating admin', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => 'Could not create admin account'
            ], 500);
        }
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
