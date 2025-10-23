<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_size',
        'status',
    ];

    public function containers()
    {
        return $this->hasMany(Container::class, 'container_type_id');
    }
}
