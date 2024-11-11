<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow Laravel's naming conventions
    protected $table = 'orders';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
    ];
    // Define any relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function orderItems()
    {
        return $this->hasMany(Order_Item::class);
    }
}
