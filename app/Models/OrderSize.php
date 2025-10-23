<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'width',
        'height',
        'length',
    ];

    protected $casts = [
        'width' => 'float',
        'height' => 'float',
        'length' => 'float',
    ];
}
