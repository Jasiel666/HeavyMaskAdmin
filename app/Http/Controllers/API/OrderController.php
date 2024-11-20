<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    public function saveOrder(Request $request)
    {
        Log::info('Order request received', ['data' => $request->all()]);

        try {
            
            $validated = $request->validate([
                'total_price' => 'required|numeric|min:0',
                'cart_items' => 'required|array',
                'cart_items.*.product_id' => 'required|numeric',
                'cart_items.*.color' => 'required|string',
                'cart_items.*.size' => 'required|string',
                'cart_items.*.quantity' => 'required|integer|min:1',
                'cart_items.*.price' => 'required|numeric|min:0',
            ]);

            
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Please log in to complete your order.'
                ], 401);
            }

          
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $validated['total_price'],
                'status' => 'Pending',
            ]);

           
            DB::transaction(function () use ($order, $validated) {
                foreach ($validated['cart_items'] as $item) {
                    $order->orderItems()->create([
                        'product_id' => $item['product_id'],
                        'color' => $item['color'],
                        'size' => $item['size'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }
            });

           
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Order created successfully'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error: please check your input',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Order processing failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Order processing failed. Please try again later.'
            ], 500);
        }
    }
}
