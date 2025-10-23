<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'currency',
        'amount',
        'payment_method',
        'file',
        'expense_id',
    ];

    protected $casts = ['date' => 'datetime', 'payment_method' => PaymentMethod::class];

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
