<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDateStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date_id',
        'status_id',
    ];

    public function booking_date()
    {
        return $this->belongsTo(BookingDate::class, 'booking_date_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
