<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemShortDeclaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'order_item_id',
    ];

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
