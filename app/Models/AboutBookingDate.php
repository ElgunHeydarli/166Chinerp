<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutBookingDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
    ];

    protected $casts = ['date' => 'datetime'];
}
