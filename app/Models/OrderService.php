<?php

namespace App\Models;

use App\Services\Admin\Setting\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $currencyService;

    protected $fillable = [
        'purchase_price',
        'purchase_currency',
        'sale_price',
        'sale_currency',
        'document_type',
        'date',
        'start_date',
        'end_date',
        'last_payment_date',
        'note',
        'service_id',
        'expense_type_id',
        'vendor_id',
        'order_item_id',
        'order_id',
    ];

    protected $casts = [
        'purchase_price' => 'float',
        'sale_price' => 'float',
        'date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_payment_date' => 'datetime',
    ];

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function expense_type()
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function calculate_price(float $price, string $valute = 'AZN')
    {
        $this->currencyService = app(CurrencyService::class);
        $currency = $this->currencyService->get_by_code($valute);
        $index = $currency->exchange?->index ?? 1;
        return $price * $index;
    }
}
