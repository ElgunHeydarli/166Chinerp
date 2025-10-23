<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'handover',
        'vin_code',
        'cbm',
        'status',
        'order_id',
    ];

    protected $casts = ['status' => OrderStatus::class];

    public function factories()
    {
        return $this->belongsToMany(Factory::class, 'order_factories', 'order_item_id', 'factory_id')
            ->using(OrderFactory::class)
            ->withPivot('id')
            ->as('orderFactory');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'order_item_id');
    }

    public function railway_bill()
    {
        return $this->hasOne(OrderItemRailwayBill::class, 'order_item_id');
    }

    public function declaration()
    {
        return $this->hasOne(OrderItemDeclaration::class, 'order_item_id');
    }

    public function short_declaration()
    {
        return $this->hasOne(OrderItemShortDeclaration::class, 'order_item_id');
    }

    public function images()
    {
        return $this->hasMany(OrderItemImage::class, 'order_item_id');
    }

    public function status_changes()
    {
        return $this->hasMany(OrderItemStatusChange::class, 'order_item_id');
    }

    public function order_item_warehouse()
    {
        return $this->hasOne(OrderItemWarehouse::class, 'order_item_id');
    }

    public function services()
    {
        return $this->hasMany(OrderService::class, 'order_item_id');
    }
}
