<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'remainder',
        'note',
        'expense_type_id',
        'vendor_id',
        'payment_type_id',
        'order_id',
    ];
}
