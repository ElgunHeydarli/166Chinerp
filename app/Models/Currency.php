<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'status',
        'sort',
    ];

    public function exchange()
    {
        return $this->hasOne(CurrencyCalculator::class, 'currency_id');
    }
}
