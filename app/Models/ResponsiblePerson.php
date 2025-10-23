<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsiblePerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'customer_property_id',
    ];
}
