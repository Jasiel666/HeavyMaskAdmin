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
}
