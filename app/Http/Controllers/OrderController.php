<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Item;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('OrdersGrid',['orders' => $orders]);
    }

    public function show($id)
    {
   
        $order = Order::with('orderItems')->findOrFail($id);

        // Pass the order with its items to the view
        return view('OrderDetails', compact('order'));
    }

   
}
