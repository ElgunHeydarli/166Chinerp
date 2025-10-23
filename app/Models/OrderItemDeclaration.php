<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemDeclaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'status',
        'order_item_id',
    ];
}
