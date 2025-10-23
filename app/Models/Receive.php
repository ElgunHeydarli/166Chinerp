<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\ReceiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'service_name',
        'invoice_date',
        'last_payment_date',
        'currency',
        'price',
        'vat',
        'total_price',
        'initial_payment',
        'remainder',
        'status',
        'customer_id',
        'order_id',
        'country_id',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'last_payment_date' => 'datetime',
        'price' => 'float',
        'vat' => 'float',
        'total_price' => 'float',
        'initial_payment' => 'float',
        'remainder' => 'float',
        'status' => ReceiveStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany(ReceivePayment::class, 'receive_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
