<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent',
        'remainder',
        'first_date',
        'last_date',
        'note',
        'payment_type_id',
        'order_id',
    ];

    protected $casts = [
        'first_date'=>'datetime',
        'last_date'=>'datetime',
    ];
}
