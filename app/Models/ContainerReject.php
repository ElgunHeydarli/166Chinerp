<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerReject extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'container_id',
        'reject_reason_id',
    ];
}
