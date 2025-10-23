<?php

namespace App\Models;

use App\Enums\CustomerType;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'fin',
        'serial_number',
        'voen',
        'note',
        'type',
        'gender',
        'note',
        'contract',
        'contract_add_date',
        'contract_number', // new column
        'bill_invoice',// new column
        'handover', // new column
        'price_agreement_protocol', // new column
        'contract_start_date',
        'contract_end_date',
        'date',
        'status',
        'user_id',
        'source_id',
        'payment_term_id',
    ];

    protected $casts = [
        'type' => CustomerType::class,
        'gender' => Gender::class,
        'contract_start_date' => 'datetime',
        'contract_end_date' => 'datetime',
        'contract_add_date' => 'datetime',
        'date' => 'datetime',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function payment_term()
    {
        return $this->belongsTo(PaymentTerm::class, 'payment_term_id');
    }

    public function property()
    {
        return $this->hasOne(CustomerProperty::class, 'customer_id');
    }

    public function files()
    {
        return $this->hasMany(CustomerFile::class, 'customer_id');
    }
}
