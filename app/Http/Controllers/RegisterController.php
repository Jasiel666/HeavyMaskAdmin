<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            Log::info('Validation failed: ' . json_encode($validator->errors()->all()));
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        try {
            // Log the attempt to create a new admin
            Log::info('Attempting to create new admin: ' . $request->username);
    
            // Create a new admin record
            $admin = Admin::create([
                'name' => $request->username,
                'password' => Hash::make($request->password),
                'is_main_admin' => false, // Set default value
            ]);
    
            Log::info('Admin created successfully: ' . $admin->id);
    
            // Redirect to login page with a success message
            return redirect()->route('Login.login')->with('success', 'Admin registered successfully.');
    
        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error registering the admin.');
        }
    }
    
}
