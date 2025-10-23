<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'order_item_id',
        'container_id',
    ];

    protected $casts = ['date' => 'datetime'];

    public function container()
    {
        return $this->belongsTo(Container::class, 'container_id');
    }
}
