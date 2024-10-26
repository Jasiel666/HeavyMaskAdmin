<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Shirt;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('AdminsGrid', ['admins' => $admins]);
    }

}