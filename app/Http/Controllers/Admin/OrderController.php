<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContainerStatus;
use App\Enums\CustomerType;
use App\Enums\OrderMixFull;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Http\Requests\Admin\DraftRequest;
use App\Http\Requests\Admin\Order\ChangeCbmRequest;
use App\Http\Requests\Admin\Order\DeclarationRequest;
use App\Http\Requests\Admin\Order\DivideOrderRequest;
use App\Http\Requests\Admin\Order\OrderImageRequest;
use App\Http\Requests\Admin\Order\RailwayBillRequest;
use App\Http\Requests\Admin\OrderBookingRequest;
use App\Http\Requests\Admin\OrderRejectRequest;
use App\Http\Requests\Admin\OrderRequest;
use App\Http\Requests\Admin\ReferrerRequest;
use App\Http\Traits\FileUploadTrait;
use App\Models\Booking;
use App\Models\OrderItem;
use App\Services\Admin\BookingDateService;
use App\Services\Admin\CommentService;
use App\Services\Admin\ContainerService;
use App\Services\Admin\CustomerService;
use App\Services\Admin\Order\OrderFactoryFileService;
use App\Services\Admin\Order\OrderFactoryService;
use App\Services\Admin\Order\OrderFactoryVinCodeService;
use App\Services\Admin\Order\OrderItemService;
use App\Services\Admin\OrderService;
use App\Services\Admin\Setting\AboutBookingDateService;
use App\Services\Admin\Setting\CarTypeService;
use App\Services\Admin\Setting\CityService;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\CustomsClearanceService;
use App\Services\Admin\Setting\DistrictService;
use App\Services\Admin\Setting\ExpenseTypeService;
use App\Services\Admin\Setting\IncotermService;
use App\Services\Admin\Setting\MixFullService;
use App\Services\Admin\Setting\PaymentTypeService;
use App\Services\Admin\Setting\PriceTypeService;
use App\Services\Admin\Setting\ProductTypeService;
use App\Services\Admin\Setting\RejectReasonService;
use App\Services\Admin\Setting\StatusService;
use App\Services\Admin\Setting\TransportationService;
use App\Services\Admin\Setting\TransportationServiceService;
use App\Services\Admin\Setting\TransportationTypeService;
use App\Services\Admin\Setting\WarehouseService;
use App\Services\Admin\VendorService;
use App\Services\CurrencyCalculatorService;
use App\Services\UserService;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;

class OrderController extends Controller
{
    use FileUploadTrait;


    public function __construct(
        public IncotermService $incotermService,
        public ContainerTypeService $containerTypeService,
        public CustomsClearanceService $customsClearanceService,
        public UserService $userService,
        public CustomerService $customerService,
        public OrderService $orderService,
        public RejectReasonService $rejectReasonService,
        public WarehouseService $warehouseService,
        public CurrencyService $currencyService,
        public TransportationService $transportationService,
        public TransportationTypeService $transportationTypeService,
        public TransportationServiceService $transportationServiceService,
        public AboutBookingDateService $aboutBookingDateService,
        public DistrictService $districtService,
        public CityService $cityService,
        public ProductTypeService $productTypeService,
        public PaymentTypeService $paymentTypeService,
        public ExpenseTypeService $expenseTypeService,
        public VendorService $vendorService,
        public ContainerService $containerService,
        public OrderFactoryService $orderFactoryService,
        public OrderFactoryVinCodeService $orderFactoryVinCodeService,
        public PriceTypeService $priceTypeService,
        public CommentService $commentService,
        public CarTypeService $carTypeService,
        public MixFullService $mixFullService,
        public BookingDateService $bookingDateService,
        public OrderItemService $orderItemService,
        public StatusService $statusService,
        public CurrencyCalculatorService $currencyCalculatorService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order_items = $this->orderItemService->filter($request);
        // $this->authorize('Bütün sifarişlər page');
        // $orders = $this->orderService->filter($request);
        $reject_reasons = $this->rejectReasonService->getAll();
        $containers = $this->containerService->getContainersByStatus(ContainerStatus::ACCEPTED);
        $order_unread_count = $this->orderService->get_unread_orders_count();
        $booking_dates = $this->bookingDateService->get_booking_dates();
        $latestStatus = $this->statusService->getLatestStatus();
        $container_types = $this->containerTypeService->getAll();
        $users = $this->userService->getUsersForRole('operator');
        $order_items->map(function ($order_item) {
            $item = $order_item->order;
            $order_item['price'] = $this->currencyCalculatorService->change_to_manat($order_item['price'] ?? 0, $item['price_currency'] ?? '$');
            $order_item['price'] = round($order_item['price'] / 1.7 * 100) / 100;
        });

        Artisan::call('notify-pending-railway');
        return view('back.pages.order.index', [
            'order_items' => $order_items,
            'reject_reasons' => $reject_reasons,
            'order_unread_count' => $order_unread_count,
            'booking_dates' => $booking_dates,
            'containers' => $containers,
            'latestStatus' => $latestStatus,
            'container_types' => $container_types,
            'users' => $users,
        ]);
    }

    public function priceless(Request $request)
    {
        $this->authorize('Qiymət gözləyən sifarişlər page');
        $orders = $this->orderService->getOrdersByStatus(OrderStatus::DRAFT);
        $orders->map(function ($item) {
            $item['price'] = $this->currencyCalculatorService->change_to_manat($item['price'] ?? 0, $item['price_currency'] ?? '$');
            $item['price'] = round($item['price'] / 1.7 * 100) / 100;
        });
        return view('back.pages.order.priceless', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customs_clearances = $this->customsClearanceService->getActive();
        $container_types = $this->containerTypeService->getActive();
        $incoterms = $this->incotermService->getActive();
        $users = $this->userService->getUsersForRole('operator');
        $mix_fulles = OrderMixFull::cases();
        $customers = $this->customerService->getAll();
        $warehouses = $this->warehouseService->getAll();
        $mix_fulles = $this->mixFullService->getAll();
        $car_types = $this->carTypeService->getAll();
        $currencies = $this->currencyService->getActive();
        return view('back.pages.order.create', compact([
            'customs_clearances',
            'container_types',
            'incoterms',
            'users',
            'mix_fulles',
            'customers',
            'warehouses',
            'mix_fulles',
            'car_types',
            'currencies',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DraftRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['status'] = is_null($data['price']) ? OrderStatus::DRAFT : OrderStatus::CONFIRMED;
            $data['code'] = $this->orderService->generate_pre_code($data['mix_full']) . '' . $this->orderService->generate_code();
            $data['apply_date'] = now();
            $data['user_id'] = auth()->id();
            $order = $this->orderService->create($data);
            $users = $this->userService->getCommentSendedUsers(['admin', 'operator']);
            $this->orderService->add_reads($order, $users);
            if ($request->hasFile('file')) {
                $file = $this->fileUpload($request->file('file'), 'orders');
                $this->orderService->add_files($order, $file);
            }
            if (!is_null($data['price'])) {
                $this->orderService->change_status($order, OrderStatus::CONFIRMED);
            }
            $this->orderService->add_items($order, []);
            $this->orderService->add_sizes($order, ['width' => [$request->get('width')], 'height' => [$request->get('height')], 'length' => [$request->get('length')]]);
            foreach ($order->items as $order_item) {
                $this->orderItemService->change_status($order_item, OrderStatus::DRAFT);
                if (!is_null($data['price'])) {
                    $this->orderItemService->change_status($order_item, OrderStatus::CONFIRMED);
                }
            }
            $warning_messages = [];
            if (($order->weight ?? 0) / ($order->cbm ?? 1) > 320)
                $warning_messages[] = 'Yükün çəkisinin həcminə olan nisbəti 320-dən böyükdür!';
            DB::commit();


            toastr('Məlumat uğurla əlavə edildi');
            return redirect()->route('admin.order.index', ['status' => $data['status']])->with('warning_messages', $warning_messages);
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr($ex->getMessage(), 'error');
            return redirect()->back()->withInput($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('Bütün sifarişlər page - Əməliyyatlar-Bax');
        $order_item = $this->orderItemService->getById($id);
        $order = $this->orderService->getById($order_item->order_id);
        $currencies = $this->currencyService->getActive();
        $price_types = $this->priceTypeService->getAll();
        $this->commentService->read_comments($order);
        $this->orderService->read_order($order);
        $order['price'] = $this->currencyCalculatorService->change_to_manat($order['price'] ?? 0, $order['price_currency'] ?? '$');
        $order['price'] = round($order['price'] / 1.7 * 100) / 100;
        return view('back.pages.order.detail', compact('order', 'currencies', 'price_types', 'order_item'));
    }

    public function details(int $id)
    {
        $order_item = $this->orderItemService->getById($id);
        $order = $this->orderService->getById($order_item->order_id);
        $order['price'] = $this->currencyCalculatorService->change_to_manat($order['price'] ?? 0, $order['price_currency'] ?? '$');
        $order['price'] = round($order['price'] / 1.7 * 100) / 100;
        $view = view('back.pages.order.section.progress-item', compact('order', 'order_item'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order_item = $this->orderItemService->getById($id);
        $order_item->factories->each(function ($factory) {
            $factory->orderFactory->load('file', 'detail', 'products', 'vin_codes');
        });
        $order = $order_item->order;
        $customs_clearances = $this->customsClearanceService->getActive();
        $container_types = $this->containerTypeService->getActive();
        $incoterms = $this->incotermService->getActive();
        $users = $this->userService->getUsersForRole('operator');
        $mix_fulles = $this->mixFullService->getAll();
        $customers = $this->customerService->getAll();
        $warehouses = $this->warehouseService->getAll();
        $currencies = $this->currencyService->getActive();
        $transportation_types = $this->transportationTypeService->getAll();
        $transportation_services = $this->transportationServiceService->getAll();
        $transportations = $this->transportationService->getAll();
        $about_booking_dates = $this->aboutBookingDateService->getAll();
        $districts = $this->districtService->getAll();
        $cities = $this->cityService->getAll();
        $product_types = $this->productTypeService->getAll();
        $payment_types = $this->paymentTypeService->getAll();
        $customers = $this->customerService->getAll();
        $car_types = $this->carTypeService->getAll();
        $users = $this->userService->getAll();
        return view('back.pages.order.edit', compact([
            'order',
            'order_item',
            'customs_clearances',
            'container_types',
            'incoterms',
            'users',
            'mix_fulles',
            'customers',
            'warehouses',
            'currencies',
            'transportation_types',
            'transportation_services',
            'transportations',
            'about_booking_dates',
            'districts',
            'cities',
            'product_types',
            'payment_types',
            'customers',
            'car_types',
            'users',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $order_item = $this->orderItemService->getById($id);
            $order = $order_item->order;
            // $data['cbm'] = $this->orderService->calculate_cbm($request, $data['container_type_id'], OrderMixFull::from($data['mix_full']));
            if ($request->hasFile('contract'))
                $data['contract'] = $this->fileUpload($request->file('contract'), 'orders');
            if ($request->hasFile('invoice'))
                $data['invoice'] = $this->fileUpload($request->file('invoice'), 'orders');
            if ($request->hasFile('packing_list'))
                $data['packing_list'] = $this->fileUpload($request->file('packing_list'), 'orders');

            DB::beginTransaction();
            $this->orderService->add_factories($order_item, $data);
            $this->orderService->update($order->id, $data);
            $this->orderService->add_payment($order, $request);
            $this->orderService->add_sizes($order, $data);
            // $this->orderService->add_items($order, $data);
            if (!is_null($data['about_booking_date'])) {
                $about_booking_date = $this->aboutBookingDateService->getByDate($data['about_booking_date']);
                if (is_null($about_booking_date))
                    $about_booking_date = $this->aboutBookingDateService->create(['date' => $data['about_booking_date'], 'status' => 1]);
                $data['about_booking_date_id'] = $about_booking_date->id;
            }
            DB::commit();
            toastr('Sifariş məlumatları uğurla əlavə olundu');
            return redirect()->route('admin.order.index', ['status' => $order->status]);
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('Bütün sifarişlər page - Əməliyyatlar-Sil');
        $order = $this->orderService->getById($id);
        foreach ($order->items as $order_item) {
            $this->orderItemService->delete($order_item->id);
        }
        $this->orderService->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi',
        ]);
    }

    public function get_details(int $id)
    {
        $order = $this->orderService->getById($id);
        return response([
            'status' => 'success',
            'data' => $order,
        ]);
    }

    public function confirm($id)
    {
        $this->authorize('Draft page - Əməliyyatlar - Təsdiq et');
        $this->orderService->update($id, ['status' => OrderStatus::CONFIRMED]);
        $order = $this->orderService->getById($id);
        $this->orderService->change_status($order, OrderStatus::CONFIRMED);
        foreach ($order->items as $order_item) {
            $this->orderItemService->change_status($order_item, OrderStatus::CONFIRMED);
            $this->orderItemService->update($order_item->id, ['status' => OrderStatus::CONFIRMED]);
        }
        toastr('Sifariş təsdiq olundu');
        return redirect()->route('admin.order.index', ['status' => OrderStatus::CONFIRMED]);
    }

    public function reject($id, OrderRejectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $order = $this->orderService->getById($id);
        $this->orderService->reject_order($order, $data);
        $this->orderService->update($id, ['status' => OrderStatus::REJECTED]);
        $this->orderService->change_status($order, OrderStatus::REJECTED);
        foreach ($order->items as $order_item) {
            $this->orderItemService->change_status($order_item, OrderStatus::REJECTED);
            $this->orderItemService->update($order_item->id, ['status' => OrderStatus::REJECTED]);
        }
        toastr('Sifariş ləğv olundu');
        return redirect()->route('admin.order.index', ['status' => OrderStatus::REJECTED]);
    }

    public function execute(int $id)
    {
        $this->authorize('Təsdiqlənən sifarişlər-Sfrş. mlmt. Daxil et-Təsdiq et');
        try {
            $order = $this->orderService->getById($id);
            DB::beginTransaction();
            $this->orderService->update($id, ['status' => OrderStatus::EXECUTE]);
            $this->orderService->change_status($order, OrderStatus::EXECUTE);
            if ($order->mix_full == 'full') {
                $container_type = $this->containerTypeService->getById($order->container_type_id);
                if ($order->container_count > 1) {
                    // $order->items()->delete();
                    for ($i = 1; $i < $order->container_count; $i++) {
                        $this->orderService->add_items($order, ['cbm' => $container_type->max_size, 'status' => OrderStatus::EXECUTE]);
                    }
                }
            }
            foreach ($order->items as $order_item) {
                $this->orderItemService->change_status($order_item, OrderStatus::EXECUTE);
                $this->orderItemService->update($order_item->id, ['status' => OrderStatus::EXECUTE]);
            }
            $this->orderService->add_receives($order);
            $this->orderService->add_journal_entries($order->payment, $order);
            DB::commit();
            toastr('Sifariş icraya götürüldü');
            return redirect()->route('admin.order.index', ['status' => OrderStatus::EXECUTE]);
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function booking($id, OrderBookingRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Rezervasiya');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($id);
        $order_item_ids = Booking::where('container_id', $data['container_id'])->pluck('order_item_id')->toArray();
        $order_items = OrderItem::with('order')->whereIn('id', $order_item_ids)->get();
        foreach ($order_items as $item) {
            if ($item->order->mix_full == $order_item->order->mix_full) {
                continue;
            } else {
                $messages = ['Bu konteyner ' . $item->order->mix_full . ' növü üçün sifariş olunmuşdur'];
                return redirect()->back()->with('error_messages', $messages);
            }
        }
        $response = $this->orderItemService->booking($order_item, $data);
        if (isset($response['messages'])) {
            return redirect()->back()->with('error_messages', $response['messages']);
        }
        toastr($response['message'], $response['status']);
        return redirect()->route('admin.order.index', ['status' => OrderStatus::EXECUTE]);
    }

    public function add_customer(CustomerRequest $request)
    {
        $data = $request->validated();
        $customer = $this->customerService->create($data);
        return response([
            'status' => 'success',
            'data' => $customer,
            'message' => 'Müştəri uğurla əlavə olundu'
        ]);
    }

    public function add_referrer(ReferrerRequest $request)
    {
        $data = $request->validated();
        $data['name'] = $data['firstname'] . ' ' . $data['lastname'];
        $data['password'] = bcrypt('Az12345678');
        $data['status'] = 1;
        $user = $this->userService->create($data);
        return response([
            'status' => 'success',
            'data' => $user,
            'message' => 'Yönləndirən şəxs uğurla əlavə olundu'
        ]);
    }

    public function add_factory(Request $request)
    {
        $counter = $request->get('counter');
        $order_id = $request->get('order_id');
        $product_types = $this->productTypeService->getAll();
        $order = $this->orderService->getById($order_id);
        $view = view('back.pages.order.section.add-factory', compact('counter', 'product_types', 'order'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function add_size(Request $request)
    {
        $counter = $request->get('counter');
        $view = view('back.pages.order.section.sizes', compact('counter'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function add_vin_code(Request $request)
    {
        $counter = $request->get('counter');
        $count = $request->get('count');
        $view = view('back.pages.order.section.add-vin-code', compact('counter', 'count'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function get_customers(Request $request)
    {
        try {
            $request->validate([
                'type' => ['required', 'in:physical,legal'],
            ]);

            $type = $request->get('type');
            $customers = $this->customerService->getAllByType(CustomerType::from($type));
            return response([
                'status' => 'success',
                'data' => $customers,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function add_expense()
    {
        $expense_types = $this->expenseTypeService->getAll();
        $payment_types = $this->paymentTypeService->getAll();
        $vendors = $this->vendorService->getAll();
        $view = view('back.pages.order.add-expense', compact('expense_types', 'payment_types', 'vendors'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function add_railway(int $id, RailwayBillRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Railway bill Upload');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($id);
        if ($request->hasFile('file'))
            $data['file'] = $this->fileUpload($request->file('file'), 'orders');
        $this->orderItemService->add_railway($order_item, $data['file']);
        toastr('Railway bill əlavə olundu');
        return redirect()->back();
    }

    public function add_declaration(int $id, DeclarationRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Deklarasiya Upload');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($id);
        if ($request->hasFile('file'))
            $data['file'] = $this->fileUpload($request->file('file'), 'orders');
        $this->orderItemService->add_declaration($order_item, $data['file']);
        toastr('Deklarasiya əlavə olundu');
        return redirect()->back();
    }

    public function add_short_declaration(int $id, DeclarationRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Qısa idxal bəyann. Upload');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($id);
        if ($request->hasFile('file'))
            $data['file'] = $this->fileUpload($request->file('file'), 'orders');
        $this->orderItemService->add_short_declaration($order_item, $data['file']);
        toastr('Qısa idxal bəyannaməsi əlavə olundu');
        return redirect()->back();
    }

    public function add_images(int $id, OrderImageRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Konteyner şəkilləri Upload');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($id);
        if ($request->hasFile('images')) {
            $data['images'] = $this->fileUpload($request->file('images'), 'orders');
            $this->orderItemService->add_images($order_item, $data['images']);
        }
        toastr('Şəkillər əlavə olundu');
        return redirect()->back();
    }

    public function change_railway_status(int $id, Request $request)
    {
        $this->authorize('İcrada olan sifarişlər-Railway bill Upload');
        $order_item = $this->orderItemService->getById($id);
        $response = $this->orderItemService->change_railway_status($order_item, $request->get('status', 0));
        return response($response);
    }

    public function change_container(int $id, Request $request)
    {
        $data = $request->validate([
            'container_id' => ['required', 'integer', 'exists:containers,id'],
        ]);
        $order_item = $this->orderItemService->getById($id);
        $booking = $order_item->booking;
        $booking_date = $this->bookingDateService->getByDate($booking->date);
        $latest_status = $booking_date->statuses()->orderByPivot('id', 'desc')->first();
        if (is_null($latest_status) || $latest_status->sort <= 1) {
            $data['date'] = $booking_date->date->format('d.m.Y');
            $booking_date->containers()->where(['container_id' => $booking->container_id, 'status' => 1])->delete();
            $this->orderItemService->booking($order_item, $data);
            $booking_date->containers()->create(['container_id' => $data['container_id']]);
            $booking->update($data);
        } else {
            toastr('Bu sifarişin konteyner nömrəsini dəyişə bilməzsiniz', 'error');
            return redirect()->back();
        }
        toastr('Rezervasiyanın konteyner nömrəsi dəyişdirildi');
        return redirect()->back();
    }

    public function add_handover(int $id, Request $request)
    {
        $this->authorize('Bitmiş sifarişlər-TT aktı Upload');
        $data = $request->validate([
            'file' => ['required', 'file'],
        ]);
        if ($request->hasFile('file'))
            $data['handover'] = $this->fileUpload($request->file('file'), 'orders');
        $order_item = $this->orderItemService->getById($id);
        $data['status'] = OrderStatus::FINISHED;
        $this->orderItemService->update($id, $data);
        $this->orderItemService->change_status($order_item, OrderStatus::FINISHED);
        toastr('Sifariş bitirildi');
        return redirect()->route('admin.order.index', ['status' => OrderStatus::FINISHED]);
    }

    public function get_cbm_info(int $id)
    {
        $order_item = $this->orderItemService->getById($id);
        return response([
            'status' => 'success',
            'cbm' => $order_item->cbm,
        ]);
    }

    public function change_cbm(ChangeCbmRequest $request)
    {
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($data['order_item_id']);
        $this->orderItemService->change_cbm($order_item, $data);
        return response([
            'status' => 'success',
            'message' => 'Yükə yeni cbm mənimsədildi',
        ]);
    }

    public function divide_order(DivideOrderRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Yükü böl');
        $data = $request->validated();
        $total_cbm = 0;
        foreach ($request->get('new_cbm', []) as $new_cbm) {
            $total_cbm += $new_cbm;
        }
        $order_item = $this->orderItemService->getById($data['order_item_id']);
        $order = $order_item->order;
        if ($total_cbm > $order->cbm) {
            return response([
                'status' => 'error',
                'message' => 'CBM-lərin cəmi ümumi CBM-dən çox ola bilməz',
            ]);
        }
        $this->orderItemService->divide_order($order, $data);
        return response([
            'status' => 'success',
            'message' => 'Yük hissələrə bölünmüşdür',
        ]);
    }

    public function filter(Request $request)
    {
        try {
            $order_items = $this->orderItemService->filter($request);
            $order_unread_count = $this->orderService->get_unread_orders_count();
            $latestStatus = $this->statusService->getLatestStatus();
            $order_items->map(function ($order_item) {
                $item = $order_item->order;
                $order_item['price'] = $this->currencyCalculatorService->change_to_manat($item['price'] ?? 0, $item['price_currency'] ?? '$');
                $order_item['price'] = round($item['price'] / 1.7 * 100) / 100;
            });
            $view = view('back.pages.order.section.filter', compact([
                'order_items',
                'latestStatus',
                'order_unread_count'
            ]))->render();
            return response([
                'status' => 'success',
                'view' => $view,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function combine(int $id)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Yükü böl');
        try {
            $order = $this->orderService->getById($id);
            $this->orderService->combine($order);
            toastr('Yük birləşdirilmişdir');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function change_user(int $id, Request $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Kuratoru dəyiş');
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $this->orderService->update($id, ['user_id' => $request->get('user_id')]);
        toastr('Kurator uğurla dəyişdirildi');
        return redirect()->back();
    }

    public function add_warehouse(int $id, Request $request)
    {
        try {
            $data = $request->validate([
                'file' => ['required', 'file'],
                'arrival_date' => ['required', 'date'],
            ]);
            $order_item = $this->orderItemService->getById($id);
            $this->orderItemService->add_warehouse($order_item, $data);
            toastr('Yük anbara əlavə olundu');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr($ex->getMessage(), 'error');
            return redirect()->back();
        }

    }

    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx']]);
        $response = $this->orderItemService->import($request);
        toastr($response['message'], $response['status']);
        return redirect()->back();
    }
}
