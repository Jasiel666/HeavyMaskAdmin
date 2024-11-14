<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'LoginName' => 'required',
            'LoginPassword' => 'required|min:8',
        ]);
    
        $admin = Admin::where('name', $request->LoginName)->first();
    
        if (!$admin || !Hash::check($request->LoginPassword, $admin->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        // Store the token in session
        $token = $admin->createToken('admin-token')->plainTextToken;
        session(['admin_api_token' => $token]);
    
        return response()->json([
            'token' => $token,
            'admin' => $admin
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Logged out successfully']);
    }
}