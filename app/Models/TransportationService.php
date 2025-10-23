<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort',
        'status',
        'transportation_type_id',
    ];

    public function transporation_type(){
        return $this->belongsTo(TransportationType::class,'transportation_type_id');
    }
}
