<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayrollAdvance extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'price',
        'user_payroll_id',
    ];

    protected $casts = [
        'price' => 'float',
        'payment_method' => PaymentMethod::class,
    ];

    public function files()
    {
        return $this->hasMany(UserPayrollAdvanceFile::class, 'user_payroll_advance_id');
    }
}
