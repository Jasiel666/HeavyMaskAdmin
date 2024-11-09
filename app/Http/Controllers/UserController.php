<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a list of all users
    public function index()
    {
        $users = User::all(); // Retrieve all users
        return view('UsersGrid', ['users' => $users]); // Pass users to the view
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Retrieve the user by ID
        $user->delete(); // Delete the user

        return redirect()->route('UsersTable')->with('success', 'User deleted successfully!');
    }
    
}