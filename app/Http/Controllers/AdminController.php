<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display a list of all admins
    public function index()
    {
        $admins = Admin::all();
        return view('AdminsGrid', ['admins' => $admins]);
    }

    // Show the form for creating a new admin
    public function create()
    {
        return view('createAdmin');
    }

    // Store a newly created admin in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'is_main_admin' => 'required|boolean',
        ]);

        // Create a new admin
        $admin = Admin::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']), // Hash password
            'is_main_admin' => $validatedData['is_main_admin'],
        ]);

        return redirect()->route('AdminsTable')->with('success', 'Admin created successfully!');
    }

    // Show the form for editing the specified admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('editAdmin', compact('admin'));
    }

    // Update the specified admin in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'is_main_admin' => 'required|boolean',
        ]);

        $admin = Admin::findOrFail($id);

        // Update admin detail
        $admin->is_main_admin = $validatedData['is_main_admin'];
        $admin->save();

        return redirect()->route('AdminsTable')->with('success', 'Admin updated successfully!');
    }

    // Delete the specified admin from the database
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('AdminsTable')->with('success', 'Admin deleted successfully!');
    }
}
