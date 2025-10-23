<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'container_type_id',
        'station_id',
        'price',
    ];

    protected $casts = ['price' => 'float'];

    public function container_type()
    {
        return $this->belongsTo(ContainerType::class, 'container_type_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
}
