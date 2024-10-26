<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'LoginName' => 'required',
            'LoginPassword' => 'required|min:8',
        ]);

        $admin = Admin::where('name', $request->input('LoginName'))->first();

      
        if ($admin && Hash::check($request->input('LoginPassword'), $admin->password)) {
            
            Auth::login($admin);

            return redirect()->route('productsInsert'); 

        } else {
         
            return redirect()->back()->withErrors(['LoginName' => 'Invalid credentials'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}