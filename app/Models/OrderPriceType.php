<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPriceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'currency',
        'price_type_id',
        'order_id',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
