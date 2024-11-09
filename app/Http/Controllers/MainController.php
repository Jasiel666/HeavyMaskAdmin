<?php

namespace App\Http\Controllers;

class MainController extends Controller
{

    public function AdminLogin() {
        return view('AdminLogin');  
    }
    public function productsInsert()
    {
        return view('productsInsert');
    }

    public function AdminGrid()
    {
        return view('AdminsGrid');
    }

    public function UserGrid()
    {
        return view('UsersGrid');

    }
    public function register()
    {
        return view('register');
    }
}
