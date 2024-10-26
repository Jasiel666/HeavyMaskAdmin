<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve admins
        $admins = Admin::all();
        // dd($admins);
        return view('AdminsGrid', ['admins' => $admins]);
       
    }

    
}