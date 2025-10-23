<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'journal_id',
        'operation_date',
        'debit_account_number',
        'debit_account_name',
        'debit_amount',
        'credit_account_number',
        'credit_account_name',
        'credit_amount',
        'currency',
        'description',
    ];
    
}
