<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'order_item_id',
    ];
}
