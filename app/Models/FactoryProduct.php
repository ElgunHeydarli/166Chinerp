<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_factory_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
