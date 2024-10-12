<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'brand_id',
        'ImageUrl',
        'ImageUrl1',
        'ImageUrl2',
    ];
}
