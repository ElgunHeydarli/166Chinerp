<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRead extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'order_id',
        'user_id',
    ];
}
