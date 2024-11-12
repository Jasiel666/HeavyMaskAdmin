<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index()
{

    $users = User::all();
    return response()->json($users);
}

    // Delete a specific user
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user by ID

        $user->delete(); // Delete the user from the database

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ], Response::HTTP_OK); // Return success response
    }
}
