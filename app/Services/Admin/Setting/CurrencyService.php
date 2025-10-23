<?php

namespace App\Services\Admin\Setting;

use App\Models\Currency;

class CurrencyService extends SettingService
{
    protected $model = Currency::class;

    public function get_by_code(string $code)
    {
        return $this->model::where('code', $code)->first();
    }

    public function get_by_symbol(?string $symbol)
    {
        return $this->model::where('symbol', $symbol)->first();
    }
}
