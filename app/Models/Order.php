<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

  
    protected $table = 'orders';

    
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function orderItems()
    {
        return $this->hasMany(Order_Item::class);
    }
}
