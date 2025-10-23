<?php

namespace App\Services\Admin;

use App\Enums\OrderMixFull;
use App\Enums\OrderStatus;
use App\Enums\ReceiveStatus;
use App\Models\ContainerType;
use App\Models\Factory;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use App\Models\Order;
use App\Models\OrderFactory;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\Receive;
use App\Services\Admin\Order\OrderFactoryDetailService;
use App\Services\Admin\Order\OrderFactoryFileService;
use App\Services\Admin\Order\OrderFactoryProductService;
use App\Services\Admin\Order\OrderFactoryService;
use App\Services\Admin\Order\OrderFactoryVinCodeService;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\MainService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderService extends MainService
{
    protected $model = Order::class;

    public function __construct(
        public FactoryService $factoryService,
        public BookingDateService $bookingDateService,
        public OrderFactoryService $orderFactoryService,
        public ContainerTypeService $containerTypeService,
        public OrderFactoryFileService $orderFactoryFileService,
        public OrderFactoryDetailService $orderFactoryDetailService,
        public OrderFactoryProductService $orderFactoryProductService,
        public OrderFactoryVinCodeService $orderFactoryVinCodeService,
        public CurrencyService $currencyService,
    ) {
    }

    public function getByStatuses(array $statuses)
    {
        return $this->model::whereHas('items', function ($q) use ($statuses) {
            return $q->whereIn('status', $statuses);
        })->get();
    }

    public function add_receives(Order $order)
    {
        $currency = $this->currencyService->get_by_symbol($order->price_currency);
        $receive = Receive::where('order_id', $order->id)->first();
        if (is_null($receive)) {
            $order->receives()->create([
                'service_name' => $order->product_name,
                'currency' => $currency?->code,
                'price' => $order->price,
                'vat' => 0,
                'total_price' => $order->price,
                'initial_payment' => 0,
                'remainder' => $order->price,
                'status' => ReceiveStatus::NOT_PAID,
                'customer_id' => $order->customer_id,
            ]);
        } else {
            $receive->update(
                [
                    'service_name' => $order->product_name,
                    'currency' => $currency?->code,
                    'price' => $order->price,
                    'vat' => 0,
                    'total_price' => $order->price,
                    'initial_payment' => 0,
                    'remainder' => $order->price,
                    'status' => ReceiveStatus::NOT_PAID,
                    'customer_id' => $order->customer_id,
                ]
            );
        }
    }

    public function add_journal_entries(OrderPayment $order_payment, Order $order)
    {
        $ledger_account_debet = LedgerAccount::where('code', '000000')->first(); // Alınacaq hesablar
        $ledger_account_credit = LedgerAccount::where('code', '401001')->first(); // Satışdan gələn gəlir
        JournalEntry::create([
            'journal_id' => rand(1, 99999999),
            'operation_date' => now(),
            'debit_account_number' => $ledger_account_debet?->code,
            'debit_account_name' => $ledger_account_debet?->title,
            'debit_amount' => $order->price,
            'credit_account_number' => $ledger_account_credit?->code,
            'credit_account_name' => $ledger_account_credit?->title,
            'credit_amount' => $order->price,
            'currency' => $order->price_currency,
            'description' => 'Satış gəliri əlavə olundu',
        ]);
    }

    public function generate_code(): string
    {
        return rand(10000000, 99999999);
    }

    public function generate_pre_code($mix_full): string
    {
        $pre_code = '';
        switch ($mix_full) {
            case 'mix':
                $pre_code = 'M';
                break;
            case 'full':
                $pre_code = 'F';
                break;
            case 'automobile':
                $pre_code = 'A';
                break;

        }

        return $pre_code;
    }

    public function get_priceless_orders()
    {
        return $this->model::whereNull('price')->get();
    }

    public function getOrdersByStatus(OrderStatus $orderStatus)
    {
        return $this->model::where('status', $orderStatus)->orderBy('created_at', 'desc')->get();
    }



    public function update_price(Order $order, array $data)
    {
        $data['user_id'] = auth()->id();
        $order->prices()->create($data);
        $this->update($order->id, ['price' => $data['price']]);
    }

    public function reject_order(Order $order, array $data)
    {
        $order_reject = $order->reject;
        if (!is_null($order_reject))
            $order_reject->update($data);
        else
            $order->reject()->create($data);
    }



    public function add_factories(OrderItem $order_item, array $data)
    {
        $factory_ids = $this->orderFactoryService->getFactoryIds($data);
        $order_item->factories()->detach();

        foreach ($factory_ids as $key => $factory_id) {
            $product_ids = $this->orderFactoryProductService->getProductIds($data['products'][$key]);
            $order_item->factories()->attach($factory_id);

            $order_factory = OrderFactory::with('vin_codes')
                ->where('order_item_id', $order_item->id)
                ->where('factory_id', $factory_id)
                ->latest('id')
                ->first();

            $detail_data = [
                'cube' => $data['factory_cube'][$key],
                'delivery_point' => $data['factory_delivery_point'][$key],
                'box_count' => $data['box_count'][$key] ?? 0,
                'palette_count' => $data['palette_count'][$key] ?? 0,
                'product_type_id' => $data['product_type_id'][$key],
                'note' => $data['factory_note'][$key],
            ];
            $vin_codes = isset($data['vin_codes'][$key]) ? $data['vin_codes'][$key] : [];
            $this->orderFactoryDetailService->add_factory_detail($order_factory, $detail_data);

            // Hər bir factory üçün yalnız ona aid olan fayl məlumatlarını seçirik
            $file_data = [
                'contract_file' => $data['contract_file'][$key] ?? null,
                'contract' => $data['contract'][$key] ?? null,
                'invoice_file' => $data['invoice_file'][$key] ?? null,
                'invoice' => $data['invoice'][$key] ?? null,
                'packing_list_file' => $data['packing_list_file'][$key] ?? null,
                'packing_list' => $data['packing_list'][$key] ?? null,
                'is_customer_upload' => $data['is_customer_upload'][$key] ?? null,
            ];

            $this->orderFactoryFileService->add_factory_files($order_factory, $file_data);
            $this->orderFactoryProductService->add_products($order_factory, $product_ids);
            $this->orderFactoryVinCodeService->add_vin_codes($order_factory, $vin_codes);
        }
    }

    public function getPaymentData(Request $request)
    {
        return $request->only([
            'payment_type_id',
            'percent',
            'remainder',
            'first_date',
            'last_date',
        ]);
    }

    public function add_payment(Order $order, Request $request)
    {
        $order_payment = $order->payment;
        $data = $this->getPaymentData($request);
        $data['note'] = $request->get('payment_note');
        $data['first_date'] = Carbon::createFromFormat('d.m.Y', $data['first_date'] ?? now()->format('d.m.Y'));
        $data['last_date'] = Carbon::createFromFormat('d.m.Y', $data['last_date'] ?? now()->format('d.m.Y'));
        if (is_null($data['percent']) || $data['percent'] == 0)
            $data['first_date'] = null;
        if (is_null($order_payment)) {
            $order->payment()->create($data);
        } else {
            $order->payment()->update($data);
        }
    }

    public function add_expenses(Order $order, array $data)
    {
        $order->expenses()->delete();
        foreach ($data['expense_type_id'] ?? [] as $key => $expense_type_id) {
            $order->expenses()->create([
                'expense_type_id' => $expense_type_id,
                'payment_type_id' => $data['payment_type_id'][$key],
                'vendor_id' => $data['vendor_id'][$key],
                'price' => $data['price'][$key] ?? 0,
                'remainder' => $data['price'][$key] ?? 0,
                'note' => $data['note'][$key] ?? '',
            ]);
        }
    }

    public function calculate_cbm(Request $request, int $container_type_id = null, OrderMixFull $mix_full): float
    {
        switch ($mix_full) {
            case OrderMixFull::FULL:
                $container_type = $this->containerTypeService->getById($container_type_id);
                $cbm = $container_type->max_size;
                break;
            case OrderMixFull::MIX:
                $cbm = $request->get('cbm');
                break;
            case OrderMixFull::AUTOMOBILE:
                $cbm = $request->get('cbm');
                break;
        }

        return $cbm;
    }

    public function calculate_order_price(array $data): float
    {
        $total_price = 0;
        foreach ($data['prices'] as $price) {
            $total_price += $price ?? 0;
        }
        return $total_price;
    }

    public function add_price_types(Order $order, array $data)
    {
        $order->price_types()->delete();
        foreach ($data['prices'] ?? [] as $key => $price) {
            $order->price_types()->create([
                'price' => $price,
                'currency' => $data['currency'][$key],
                'price_type_id' => $data['price_type_ids'][$key],
            ]);
        }
    }

    public function change_status(Order $order, OrderStatus $status)
    {
        $order->status_changes()->create([
            'status' => $status,
        ]);
    }

    public function add_files(Order $order, string $file)
    {
        $order->files()->create([
            'file' => $file,
        ]);
    }

    public function add_reads(Order $order, $users)
    {
        foreach ($users as $user) {
            $order->reads()->create([
                'user_id' => $user->id
            ]);
        }
    }

    public function read_order(Order $order)
    {
        $order_read = $order->reads()->where('user_id', auth()->id())->first();
        if (!is_null($order_read)) {
            $order_read->update([
                'status' => 1
            ]);
        }
    }

    public function get_unread_orders_count(): int
    {
        $unread_orders = $this->model::whereHas('reads', function ($q) {
            return $q->where('user_id', auth()->id())->where('status', 0);
        })->get();
        return count($unread_orders);
    }

    public function add_sizes(Order $order, array $data)
    {
        $order->sizes()->delete();
        foreach ($data['width'] ?? [] as $key => $width) {
            $order->sizes()->create([
                'width' => $width,
                'length' => $data['length'][$key] ?? null,
                'height' => $data['height'][$key] ?? null,
            ]);
        }
    }

    public function add_items(Order $order, array $data)
    {
        $order_items = $order->items;
        $railway_bill_data = [];
        $railway_bill_status_data = [];
        $declaration_data = [];
        $short_declaration_data = [];
        $images_data = [];
        foreach ($order_items as $order_item) {
            $railway_bill_data[] = $order_item->railway_bill?->file;
            $railway_bill_status_data[] = $order_item->railway_bill?->status ?? 0;
            $declaration_data[] = $order_item->declaration?->file;
            $short_declaration_data[] = $order_item->short_declaration?->file;
            $images_data[] = $order_item->images()->pluck('image')->toArray();
        }
        if (isset($data['vin_codes'])) {
            $order->items()->delete();
            foreach ($data['vin_codes'] as $key => $vinCodes) {
                foreach ($vinCodes as $vin_code) {
                    $order_item = $order->items()->create(['vin_code' => $vin_code, 'cbm' => round(68 / 3 * 100) / 100, 'status' => $order->status]);
                    if (isset($railway_bill_data[$key])) {
                        $order_item->railway_bill()->create([
                            'file' => isset($railway_bill_data[$key]) ? $railway_bill_data[$key] : null,
                            'status' => isset($railway_bill_status_data[$key]) ? $railway_bill_status_data[$key] : null,
                        ]);
                    }

                    if (isset($declaration_data[$key])) {
                        $order_item->declaration()->create([
                            'file' => isset($declaration_data[$key]) ? $declaration_data[$key] : null
                        ]);
                    }

                    if (isset($short_declaration_data[$key])) {
                        $order_item->short_declaration()->create([
                            'file' => isset($short_declaration_data[$key]) ? $short_declaration_data[$key] : null,
                        ]);
                    }

                    if (isset($images_data[$key])) {
                        foreach ($images_data[$key] as $image) {
                            $order_item->images()->create(['image' => $image]);
                        }
                    }
                }
            }
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'cbm' => isset($data['cbm']) ? $data['cbm'] : $order->cbm,
                'status' => isset($data['status']) ? $data['status'] : $order->status
            ]);
        }
    }

    public function filter(Request $request)
    {
        $query = $this->model::query()->orderBy('apply_date', 'desc');
        $sort_by = $request->get('sort_by');
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $status = $request->get('status');
        $type = $request->get('type');
        if (!empty($search)) {
            $query->where('code', 'like', "%$search%");
        }

        if (!is_null($status)) {
            $query->where("status", OrderStatus::from($status));
        }

        if (!is_null($type)) {
            $query->where('mix_full', $type);
        }

        if (!is_null($request->get('start_date')) && !is_null($request->get('end_date'))) {
            $start_date = Carbon::createFromFormat('d.m.Y', $request->get('start_date'))->startOfDay();
            $end_date = Carbon::createFromFormat('d.m.Y', $request->get('end_date'))->startOfDay();
            $query->whereBetween('apply_date', [$start_date, $end_date]);
        }

        switch ($sort_by) {
            case 'name_asc':
                break;
            case 'name_desc':
                break;
            case 'old_to_new':
                break;
            case 'new_to_old':
                break;
            case 'apply_date':
                break;
            case 'booking_date':
                break;
            default:
                break;
        }

        $orders = $query->paginate($limit);
        return $orders;
    }

    public function combine(Order $order)
    {
        $order->items()->delete();
        $order->items()->create([
            'cbm' => $order->cbm,
            'status' => $order->status,
        ]);
    }
}
