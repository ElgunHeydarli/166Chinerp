<?php

namespace App\Models;

use App\Enums\ExpenseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'total_price',
        'pay_price',
        'remainder',
        'last_payment_date',
        'currency',
        'expense_type',
        'factory',
        'note',
        'status',
        'order_id',
        'expense_category_id',
        'expense_sub_category_id',
        'account_id',
    ];

    protected $casts = [
        'total_price' => 'float',
        'pay_price' => 'float',
        'remainder' => 'float',
        'last_payment_date' => 'datetime',
        'expense_type' => ExpenseType::class,
    ];

    public function account()
    {
        return $this->belongsTo(LedgerAccount::class, 'account_id'); // ✅ düzəliş
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(ExpenseSubCategory::class, 'expense_sub_category_id');
    }

    public function payments()
    {
        return $this->hasMany(ExpensePayment::class, 'expense_id');
    }
}
