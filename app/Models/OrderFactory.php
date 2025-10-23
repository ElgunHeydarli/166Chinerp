<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderFactory extends Pivot
{
    use HasFactory;

    protected $table = 'order_factories';

    protected $fillable = [
        'factory_id',
        'order_item_id',
    ];

    public function file()
    {
        return $this->hasOne(FactoryFile::class, 'order_factory_id');
    }

    public function products()
    {
        return $this->hasMany(FactoryProduct::class, 'order_factory_id');
    }

    public function vin_codes()
    {
        return $this->hasMany(FactoryVinCode::class, 'order_factory_id');
    }

    public function detail()
    {
        return $this->hasOne(FactoryDetail::class, 'order_factory_id');
    }
}
