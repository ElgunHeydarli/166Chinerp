<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CurrencyCalculatorService;
use Illuminate\Http\Request;

class CurrencyCalculatorController extends Controller
{
    public function __construct(public CurrencyCalculatorService $currencyCalculatorService) {}

    public function index()
    {
        $response = $this->currencyCalculatorService->add_currencies();
        return response($response);
    }
}
