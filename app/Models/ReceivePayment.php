<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'currency',
        'file',
        'price',
        'payment_method',
        'note',
        'receive_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'price' => 'float',
        'payment_method' => \App\Enums\PaymentMethod::class,
    ];

    public function receive()
    {
        return $this->belongsTo(Receive::class, 'receive_id');
    }
}
