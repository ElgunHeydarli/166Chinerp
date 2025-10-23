<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemRailwayBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'status',
        'last_notified_at',
        'order_item_id',
    ];

    protected $casts = ['last_notified_at' => 'datetime'];

    public function status_changes()
    {
        return $this->hasMany(OrderItemRailwayStatusChange::class, 'order_item_railway_bill_id');
    }

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
