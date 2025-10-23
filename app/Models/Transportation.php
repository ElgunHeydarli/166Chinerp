<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort',
        'status',
        'transportation_service_id',
    ];

    public function transportation_service()
    {
        return $this->belongsTo(TransportationService::class, 'transportation_service_id');
    }
}
