<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_payment',
        'bank_payment',
        'government_payment',
        'withholding_payment',
        'bonus',
        'last_payment_date',
        'bank_file',
        'cash_file',
        'status',
        'currency',
        'payment_method',
        'user_id',
    ];

    protected $casts = [
        'cash_payment' => 'float',
        'bank_payment' => 'float',
        'government_payment' => 'float',
        'withholding_payment' => 'float',
        'bonus' => 'float',
        'last_payment_date' => 'datetime',
        'payment_method' => PaymentMethod::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function advance()
    {
        return $this->hasOne(UserPayrollAdvance::class, 'user_payroll_id');
    }
}
