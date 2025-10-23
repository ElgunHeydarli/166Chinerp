<?php

namespace App\Models;

use App\Enums\ContainerStatus;
use App\Enums\PurchaseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'purchase_type',
        'purchase_date',
        'count',
        'price',
        'price_currency',
        'weight',
        'empty_volume',
        'packed_volume',
        'volume',
        'status',
        'last_payment_date',
        'container_type_id',
        'vendor_id',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'last_payment_date' => 'datetime',
        'empty_volume' => 'float',
        'packed_volume' => 'float',
        'purchase_type' => PurchaseType::class,
        'status' => ContainerStatus::class,
    ];

    public function booking_containers()
    {
        return $this->hasMany(BookingDateContainer::class, 'container_id');
    }

    public function container_type()
    {
        return $this->belongsTo(ContainerType::class, 'container_type_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'container_id');
    }

    public function reject()
    {
        return $this->hasOne(ContainerReject::class, 'container_id');
    }

    public function images()
    {
        return $this->hasMany(ContainerImage::class, 'container_id');
    }
}
