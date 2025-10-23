<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryVinCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_factory_id',
        'vin_code',
    ];
}
