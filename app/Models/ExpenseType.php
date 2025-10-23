<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort',
        'status',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
