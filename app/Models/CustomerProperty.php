<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'voen',
        'legal_address',
        'factical_address',
        'bank_voen',
        'bank_name',
        'code',
        'account',
        'agent_account',
        'swift',
        'director',
        'sector_id',
        'customer_id',
    ];

    public function responsible_persons()
    {
        return $this->hasMany(ResponsiblePerson::class, 'customer_property_id');
    }
}
