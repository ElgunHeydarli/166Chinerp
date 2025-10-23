<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedCargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'image',
        'file',
        'order_id',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
