<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'sort',
    ];

    public function sub_categories()
    {
        return $this->hasMany(ExpenseSubCategory::class, 'expense_category_id');
    }
}
