<?php

namespace App\Services\Admin\Account;

use App\Enums\PaymentMethod;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\CurrencyCalculatorService;
use App\Services\MainService;
use App\Models\Receive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceiveService extends MainService
{
    protected $model = Receive::class;

    public function __construct(
        public CurrencyCalculatorService $currencyCalculatorService,
        public CurrencyService $currencyService
    ) {

    }

    public function filter(Request $request)
    {
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $status = $request->get('status');

        $query = $this->model::query()->orderBy('created_at', 'desc');

        if (!is_null($search)) {
            $query
                ->where(function ($q) use ($search) {
                    $q->whereHas('customer', function ($q) use ($search) {
                        return $q->where('name', 'like', "%$search%");
                    })
                        ->orWhereHas('order', function ($q) use ($search) {
                            return $q->where('code', 'like', "%$search%");
                        })
                        ->orWhere('invoice_id', 'like', "%$search%")
                        ->orWhere('service_name', 'like', "%$search%");
                });

        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('last_payment_date', [$start, $end]);
        }

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        return $query->paginate($limit);
    }

    public function add_payments(Receive $receive, array $data)
    {
        $payment = $receive->payments()->create($data);
        $ledger_account_debet = LedgerAccount::where('code', '101001')->first();
        $ledger_account_credit = LedgerAccount::where('code', '000000')->first();
        if ($payment->payment_method == PaymentMethod::BANK)
            $ledger_account_debet = LedgerAccount::where('code', '102001')->first();
        JournalEntry::create([
            'journal_id' => rand(10000000, 99999999),
            'operation_date' => $payment->date,
            'debit_account_number' => $ledger_account_debet?->code,
            'debit_account_name' => $ledger_account_debet?->title,
            'debit_amount' => $payment->price,
            'credit_account_number' => $ledger_account_credit?->code,
            'credit_account_name' => $ledger_account_credit?->title,
            'credit_amount' => $payment->price,
            'currency' => $payment->currency ?? '$',
            'description' => "{$payment->payment_method->label()} ödənişi həyata keçirildi",
        ]);

    }

    public function get_total_prices(Request $request): array
    {
        $receives = $this->filter($request);
        $currencies = $this->currencyService->getAll();
        $today = now()->startOfDay();
        $weekAhead = $today->copy()->addDays(7)->endOfDay();
        $total_price_arr = [];
        $total_late_price_arr = [];
        $total_paid_price_arr = [];
        $total_upcoming_price_arr = [];
        foreach ($currencies as $currency) {
            $total_price = 0;
            $total_late_price = 0;
            $total_paid_price = 0;
            $total_upcoming_price = 0;
            foreach ($receives as $receive) {
                $due = $receive->last_payment_date;
                $receive_currency = $this->currencyService->get_by_code($receive->currency ?? 'AZN');
                $total_price += $this->currencyCalculatorService->change_to_manat($receive->remainder ?? 0, $receive_currency->symbol);
                if ($due && $due->lt($today)) { // <— BURANI dəyiş: '>' yox, '<'
                    $total_late_price += $this->currencyCalculatorService->change_to_manat($receive->price ?? 0, $receive_currency->symbol);
                } else {
                    if ($due && $due->gte($today) && $due->lte($weekAhead)) {
                        $total_upcoming_price += $this->currencyCalculatorService->change_to_manat($receive->price ?? 0, $receive_currency->symbol);
                    }
                }

                $total_paid_price += $this->currencyCalculatorService->change_to_manat($receive->payments->sum('price') ?? 0, $receive_currency->symbol);
            }
            $currency_index = $this->currencyCalculatorService->get_index($currency->symbol);
            $total_price_arr[$currency->code] = $total_price / $currency_index;
            $total_late_price_arr[$currency->code] = $total_late_price / $currency_index;
            $total_upcoming_price_arr[$currency->code] = $total_upcoming_price / $currency_index;
            $total_paid_price_arr[$currency->code] = $total_paid_price / $currency_index;
        }

        return [
            'total_price' => $total_price_arr,
            'total_late_price' => $total_late_price_arr,
            'total_paid_price' => $total_paid_price_arr,
            'total_upcoming_price' => $total_upcoming_price_arr,
        ];
    }

    public function add_entry(Receive $receive)
    {
        $ledger_account = LedgerAccount::where('title', 'Alınacaq hesablar')->first();

        JournalEntry::create([
            'journal_id' => $receive->id,
            'operation_date' => $receive->invoice_date,
            'debit_account_number' => $ledger_account?->code,
            'debit_account_name' => $ledger_account?->title,
            'debit_amount' => $receive->price,
            'credit_account_number' => $ledger_account?->code,
            'credit_account_name' => $ledger_account?->title,
            'credit_amount' => $receive->price,
            'currency' => $receive->currency ?? 'AZN',
            'description' => 'Xərc əlavə edildi',
        ]);
    }
}
