<?php

namespace App\Services\Admin\Order;

use App\Enums\ReceiveStatus;
use App\Enums\ServiceType;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use App\Models\OrderService;
use App\Models\Receive;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\MainService;
use DB;

class OrderServiceService extends MainService
{
    protected $model = OrderService::class;

    public function __construct(public CurrencyService $currencyService)
    {

    }

    public function getServicesByType(int $order_item_id, ?int $service_id)
    {
        $query = $this->model::query()
            ->where('order_item_id', $order_item_id);
        if (!is_null($service_id)) {
            $query->where('service_id', $service_id);
        }
        $services = $query->get();
        return $services;
    }

    public function addMultipleData(array $data)
    {
        foreach ($data['service_id'] as $key => $service_id) {
            DB::beginTransaction();
            $order_service = $this->create([
                'service_id' => $service_id,
                'vendor_id' => isset($data['vendor_id'][$key]) ? $data['vendor_id'][$key] : null,
                'expense_type_id' => isset($data['expense_type'][$key]) ? $data['expense_type'][$key] : null,
                'document_type' => isset($data['document_type'][$key]) ? $data['document_type'][$key] : null,
                'purchase_price' => isset($data['purchase_price'][$key]) ? $data['purchase_price'][$key] : null,
                'purchase_currency' => isset($data['purchase_currency'][$key]) ? $data['purchase_currency'][$key] : 'AZN',
                'sale_price' => isset($data['sale_price'][$key]) ? $data['sale_price'][$key] : null,
                'sale_currency' => isset($data['sale_currency'][$key]) ? $data['sale_currency'][$key] : 'AZN',
                'date' => isset($data['date'][$key]) ? $data['date'][$key] : null,
                'start_date' => isset($data['start_date'][$key]) ? $data['start_date'][$key] : null,
                'end_date' => isset($data['end_date'][$key]) ? $data['end_date'][$key] : null,
                'note' => isset($data['note'][$key]) ? $data['note'][$key] : null,
                'order_id' => $data['order_id'],
                'order_item_id' => $data['order_item_id'],
            ]);
            $this->add_receive($order_service);
            $this->add_journal_entries($order_service);
            DB::commit();
        }
    }

    public function add_receive(OrderService $order_service)
    {
        $order = $order_service->order_item->order;
        $currency = $this->currencyService->get_by_symbol($order_service->sale_currency);
        Receive::create([
            'order_id' => $order->id,
            'service_name' => $order_service->service?->name,
            'currency' => $currency?->code,
            'price' => $order_service->sale_price,
            'vat' => 0,
            'total_price' => $order_service->sale_price,
            'initial_payment' => 0,
            'remainder' => $order_service->sale_price,
            'status' => ReceiveStatus::NOT_PAID,
            'customer_id' => $order->customer_id,
        ]);
    }

    public function add_journal_entries(OrderService $order_service)
    {
        $ledger_account_debet = LedgerAccount::where('code', '000000')->first();
        $ledger_account_credit = LedgerAccount::where('code', '111111')->first();
        JournalEntry::create([
            'journal_id' => rand(1, 99999999),
            'operation_date' => now(),
            'debit_account_number' => $ledger_account_debet?->code,
            'debit_account_name' => $ledger_account_debet?->title,
            'debit_amount' => $order_service->sale_price,
            'credit_account_number' => $ledger_account_credit?->code,
            'credit_account_name' => $ledger_account_credit?->title,
            'credit_amount' => $order_service->sale_price,
            'currency' => $order_service->sale_currency,
            'description' => 'Xidmət satışı əlavə olundu',
        ]);
    }
}
