<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDatePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'entry_to_warehouse_date',
        'price',
        'currency',
        'file',
        'status',
        'booking_date_id',
    ];

    protected $casts = [
        'entry_to_warehouse_date' => 'datetime',
        'price' => 'float',
    ];
}
