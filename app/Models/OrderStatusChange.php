<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected $casts = [
        'status' => OrderStatus::class,
    ];
}
