<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'sort',
    ];

    public function details()
    {
        return $this->hasMany(ServiceDetail::class, 'service_id');
    }
}
