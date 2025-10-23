<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'last_payment_date',
        'count',
        'price',
        'total_price',
        'total_cbm',
        'remainder',
        'remainder_cbm',
        'remainder_count',
        'status',
        'container_type_id',
        'station_id',
        'vendor_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'last_payment_date' => 'datetime',
        'price' => 'float',
        'total_price' => 'float',
        'remainder' => 'float',
        'total_cbm' => 'float',
        'remainder_cbm' => 'float',
    ];

    public function getCurrentStatusIdAttribute()
    {
        return $this->statuses()->orderByPivot('created_at', 'desc')->first()?->id;
    }

    public function container_type()
    {
        return $this->belongsTo(ContainerType::class, 'container_type_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function containers()
    {
        return $this->hasMany(BookingDateContainer::class, 'booking_date_id');
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'booking_date_statuses');
    }

    public function payments()
    {
        return $this->hasMany(BookingDatePayment::class, 'booking_date_id');
    }
}
