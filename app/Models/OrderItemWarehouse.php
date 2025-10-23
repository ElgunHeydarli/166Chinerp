<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemWarehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrival_date',
        'file',
        'order_item_id',
    ];

    protected $casts = ['arrival_date' => 'datetime'];

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
