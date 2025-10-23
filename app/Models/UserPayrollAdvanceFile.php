<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayrollAdvanceFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'user_payroll_advance_id',
    ];
}
