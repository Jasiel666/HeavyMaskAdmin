<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id', 
        'color',
        'size',
        'quantity',
        'price'
    ];

    // Define the relationship to the Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function shirt()
    {
        return $this->belongsTo(Shirt::class, 'product_id', 'id');
    }


}
