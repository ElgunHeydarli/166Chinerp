<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReject extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'user_id',
        'reject_reason_id',
        'order_id',
    ];

    public function reject_reason()
    {
        return $this->belongsTo(RejectReason::class, 'reject_reason_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
