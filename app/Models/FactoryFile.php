<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract',
        'invoice',
        'packing_list',
        'is_customer_upload',
        'order_factory_id',
    ];
}
