<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cube',
        'delivery_point',
        'box_count',
        'palette_count',
        'car_count',
        'vin_code',
        'note',
        'product_type_id',
        'order_factory_id',
    ];
}
