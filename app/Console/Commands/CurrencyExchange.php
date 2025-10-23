<?php

namespace App\Console\Commands;

use App\Services\CurrencyCalculatorService;
use Illuminate\Console\Command;

class CurrencyExchange extends Command
{
    protected $currencyCalculatorService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency-exchange';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->currencyCalculatorService = app(CurrencyCalculatorService::class);
        $response = $this->currencyCalculatorService->add_currencies();
        return $response;
    }
}
