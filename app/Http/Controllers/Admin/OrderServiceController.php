<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ServiceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderService\CreateRequest;
use App\Http\Requests\Admin\OrderService\EditRequest;
use App\Services\Admin\Order\OrderItemService;
use App\Services\Admin\Order\OrderServiceService;
use App\Services\Admin\OrderService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\DocumentTypeService;
use App\Services\Admin\Setting\ExpenseTypeService;
use App\Services\Admin\Setting\ServiceService;
use App\Services\Admin\VendorService;
use App\Services\CurrencyCalculatorService;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    public function __construct(
        public OrderServiceService $orderServiceService,
        public ServiceService $serviceService,
        public OrderService $orderService,
        public OrderItemService $orderItemService,
        public VendorService $vendorService,
        public DocumentTypeService $documentTypeService,
        public ExpenseTypeService $expenseTypeService,
        public CurrencyService $currencyService,
        public CurrencyCalculatorService $currencyCalculatorService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər');
        $order_item = $this->orderItemService->getById($request->get('order_item_id'));
        $service_id = $request->get('service_id');
        $services = $this->serviceService->getActive();
        $order_services = $this->orderServiceService->getServicesByType($order_item->id, $service_id);
        $order_services->map(function ($item) {
            $item['purchase_price'] = $this->currencyCalculatorService->change_to_manat($item['purchase_price'] ?? 0, $item['purchase_currency'] ?? '$');
            $item['purchase_price'] = round($item['purchase_price'] / 1.7 * 100) / 100;
            $item['sale_price'] = $this->currencyCalculatorService->change_to_manat($item['sale_price'] ?? 0, $item['sale_currency'] ?? '$');
            $item['sale_price'] = round($item['sale_price'] / 1.7 * 100) / 100;
        });
        return view('back.pages.order-service.index', compact('order_item', 'order_services', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət əlavə et');
        $order_item = $this->orderItemService->getById($request->get('order_item_id'));
        $vendors = $this->vendorService->getAll();
        $document_types = $this->documentTypeService->getAll();
        $expense_types = $this->expenseTypeService->getAll();
        $services = $this->serviceService->getActive();
        $currencies = $this->currencyService->getActive();
        return view('back.pages.order-service.create', compact([
            'order_item',
            'vendors',
            'expense_types',
            'document_types',
            'services',
            'currencies',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət əlavə et');
        $data = $request->validated();
        $order_item = $this->orderItemService->getById($data['order_item_id']);
        $data['order_id'] = $order_item->order_id;
        $this->orderServiceService->addMultipleData($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.order-service.index', ['order_item_id' => $request->get('order_item_id')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət bax');
        $order_service = $this->orderServiceService->getById($id);
        $order_service['purchase_price'] = $this->currencyCalculatorService->change_to_manat($order_service['purchase_price'] ?? 0, $order_service['purchase_currency'] ?? '$');
        $order_service['purchase_price'] = round($order_service['purchase_price'] / 1.7 * 100) / 100;
        $order_service['sale_price'] = $this->currencyCalculatorService->change_to_manat($order_service['sale_price'] ?? 0, $order_service['sale_currency'] ?? '$');
        $order_service['sale_price'] = round($order_service['sale_price'] / 1.7 * 100) / 100;
        return view('back.pages.order-service.detail', compact('order_service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət düzəliş et');
        $order_service = $this->orderServiceService->getById($id);
        $order_item = $this->orderItemService->getById($order_service->order_item_id);
        $vendors = $this->vendorService->getAll();
        $document_types = $this->documentTypeService->getAll();
        $expense_types = $this->expenseTypeService->getAll();
        $services = $this->serviceService->getActive();
        $currencies = $this->currencyService->getActive();
        return view('back.pages.order-service.edit', compact('order_service', 'order_item', 'vendors', 'document_types', 'expense_types', 'services', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət düzəliş et');
        $data = $request->validated();
        $order_service = $this->orderServiceService->getById($id);
        $this->orderServiceService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.order-service.index', ['order_item_id' => $order_service->order_item_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('İcrada olan sifarişlər-Əməliyyatlar-Xidmətlər-Xidmət sil');
        $order_id = $this->orderServiceService->getById($id)->order_id;
        $service_type = $this->orderServiceService->getById($id)->service_type;
        $this->orderServiceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.order-service.index', ['order_id' => $order_id, 'service_type' => $service_type]);
    }

    public function add_service()
    {
        $vendors = $this->vendorService->getAll();
        $expense_types = $this->expenseTypeService->getAll();
        $document_types = $this->documentTypeService->getAll();
        $services = $this->serviceService->getActive();
        $currencies = $this->currencyService->getActive();
        $view = view('back.pages.order-service.section.add-service', compact('vendors', 'expense_types', 'document_types', 'services', 'currencies'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function get_service_details(int $id)
    {
        $service = $this->serviceService->getById($id);
        return response([
            'status' => 'success',
            'data' => $service->details,
        ]);
    }

    public function get_expense_types(int $id)
    {
        $expense_types = $this->serviceService->get_expense_types($id);
        return response([
            'status' => 'success',
            'data' => $expense_types,
        ]);
    }
}
