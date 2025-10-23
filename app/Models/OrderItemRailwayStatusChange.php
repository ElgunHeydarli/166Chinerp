<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemRailwayStatusChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'file',
        'order_item_railway_bill_id',
    ];

    public function order_item_railway_bill()
    {
        return $this->belongsTo(OrderItemRailwayBill::class, 'order_item_railway_bill_id');
    }
}
