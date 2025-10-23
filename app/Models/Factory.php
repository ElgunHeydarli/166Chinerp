<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function detail()
    {
        return $this->hasOne(FactoryDetail::class, 'factory_id');
    }

    public function files()
    {
        return $this->hasMany(FactoryFile::class, 'factory_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'factory_products');
    }
}
