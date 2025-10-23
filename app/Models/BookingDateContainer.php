<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDateContainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'status',
        'booking_date_id',
        'container_id',
        'container_check_reason_id',
    ];

    public function booking_date()
    {
        return $this->belongsTo(BookingDate::class, 'booking_date_id');
    }

    public function container_check_reason()
    {
        return $this->belongsTo(ContainerCheckReason::class, 'container_check_reason_id');
    }

    public function container()
    {
        return $this->belongsTo(Container::class, 'container_id');
    }
}
