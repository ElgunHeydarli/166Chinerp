<?php

namespace App\Models;

use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'customer_type',
        'vendor_name',
        'chinese_name',
        'role',
        'start_date',
        'end_date',
        'voen',
        'legal_address',
        'factical_address',
        'bank',
        'bank_voen',
        'code',
        'account',
        'agent_account',
        'swift',
        'director',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'customer_type' => CustomerType::class,
    ];

    public function file()
    {
        return $this->hasOne(VendorFile::class, 'vendor_id');
    }
}
