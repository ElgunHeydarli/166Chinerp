<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyCalculator;
use App\Services\Admin\Setting\CurrencyService;
use Illuminate\Support\Facades\Http;

class CurrencyCalculatorService extends MainService
{
    protected $model = CurrencyCalculator::class;
    public function __construct(public CurrencyService $currencyService)
    {
    }

    public function add_currencies()
    {
        $response = $this->send_api_request();
        if ($response['status'] == 'success') {
            $data = $response['data'];
            foreach ($data->ValType as $valType) {
                foreach ($valType->Valute as $valute) {
                    $currency = $this->currencyService->get_by_code((string) $valute['Code']);
                    if (is_null($currency))
                        continue;
                    $currency_calculator = $this->model::where('currency_id', $currency->id)->first();
                    if (is_null($currency_calculator))
                        $this->create(['index' => $valute->Value, 'currency_id' => $currency->id]);
                    else
                        $this->update($currency_calculator->id, ['index' => $valute->Value]);
                }
            }
            return [
                'status' => 'success',
                'message' => 'Valyuta çevrilməsi tamamlanmışdır',
            ];
        } else {
            return $response;
        }
    }

    public function send_api_request(): array
    {
        $url = 'https://cbar.az/currencies/29.04.2025.xml';
        $response = Http::get($url);
        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            return [
                'status' => 'success',
                'data' => $xml,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Sorğu uğursuzdur',
            ];
        }
    }

    public function change_to_manat(float $price, string $symbol) : float
    {
        $index = $this->get_index($symbol);
        return $price * $index;
    }

    public function get_index(string $symbol = '$')
    {
        $currency = Currency::where('symbol', $symbol)->first();
        $index = 1;
        if (!is_null($currency)) {
            $currency_calculator = $this->model::where('currency_id', $currency->id)->first();
            if (!is_null($currency_calculator)) {
                $index = $currency_calculator->index;
            }
        }
        return $index;
    }
}
