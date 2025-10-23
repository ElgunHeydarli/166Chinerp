<?php

namespace App\Http\Controllers\Admin\Account;

use App\Enums\OrderStatus;
use App\Enums\ReceiveStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\Receive\CreateRequest;
use App\Http\Requests\Admin\Account\Receive\EditRequest;
use App\Http\Requests\Admin\Account\Receive\PayRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\Account\ReceivePaymentService;
use App\Services\Admin\Account\ReceiveService;
use App\Services\Admin\CustomerService;
use App\Services\Admin\OrderService;
use App\Services\Admin\Setting\CountryService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\CurrencyCalculatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiveController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public ReceiveService $receiveService,
        public CurrencyService $currencyService,
        public CustomerService $customerService,
        public ReceivePaymentService $receivePaymentService,
        public CurrencyCalculatorService $currencyCalculatorService,
        public OrderService $orderService,
        public CountryService $countryService,
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $receives = $this->receiveService->filter($request);
        return view('back.pages.account.receive.index', compact('receives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = $this->currencyService->getActive();
        $customers = $this->customerService->getAll();
        $orders = $this->orderService->getByStatuses([OrderStatus::CONFIRMED, OrderStatus::EXECUTE, OrderStatus::EXECUTE]);
        $countries = $this->countryService->getActive();
        return view('back.pages.account.receive.create', compact('currencies', 'customers', 'orders', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $receive = $this->receiveService->create($data);
            $this->receiveService->add_entry($receive);
            DB::commit();
            toastr('Məlumat əlavə olundu');
            return redirect()->route('admin.receive.index');
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
        $currencies = $this->currencyService->getActive();
        $receive = $this->receiveService->getById($id);
        return view('back.pages.account.receive.detail', compact('receive', 'currencies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $currencies = $this->currencyService->getActive();
        $customers = $this->customerService->getAll();
        $receive = $this->receiveService->getById($id);
        $orders = $this->orderService->getByStatuses([OrderStatus::CONFIRMED, OrderStatus::EXECUTE, OrderStatus::EXECUTE]);
        $countries = $this->countryService->getActive();
        return view('back.pages.account.receive.edit', compact('receive', 'customers', 'currencies', 'orders', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $this->receiveService->update($id, $data);
            toastr('Məlumat yeniləndi');
            return redirect()->route('admin.receive.index');
        } catch (\Exception $ex) {
            toastr($ex->getMessage(), 'error');
            return redirect()->back()->withInput($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->receiveService->delete($id);
        return redirect()->route('admin.receive.index');
    }

    public function filter(Request $request)
    {
        $receives = $this->receiveService->filter($request);
        $view = view('back.pages.account.receive.section.filter', compact('receives'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function history(Request $request)
    {
        $receive_payments = $this->receivePaymentService->filter($request)['receives'];
        $all_receives = $this->receivePaymentService->filter($request)['all_receives'];
        return view('back.pages.account.receive.history', compact('receive_payments', 'all_receives'));
    }

    public function history_filter(Request $request)
    {
        $receive_payments = $this->receivePaymentService->filter($request)['receives'];
        $all_receives = $this->receivePaymentService->filter($request)['all_receives'];
        $view = view('back.pages.account.receive.section.history', compact('receive_payments', 'all_receives'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function report(Request $request)
    {
        $total_prices = $this->receiveService->get_total_prices($request);
        $currencies = $this->currencyService->getActive();
        return view('back.pages.account.receive.report', compact('currencies', 'total_prices'));
    }

    public function report_filter(Request $request)
    {
        $total_prices = $this->receiveService->get_total_prices($request);
        $currencies = $this->currencyService->getActive();
        $view = view('back.pages.account.receive.section.report-filter', compact('total_prices', 'currencies'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function pay(int $id, PayRequest $request)
    {
        $data = $request->validated();
        try {
            $receive = $this->receiveService->getById($id);
            DB::beginTransaction();
            if ($request->hasFile('file'))
                $data['file'] = $this->fileUpload($request->file('file'), 'receives');
            $this->receiveService->add_payments($receive, $data);
            $remainder = $receive->remainder - $data['price'];
            $this->receiveService->update($id, ['remainder' => $remainder]);
            if ($remainder <= 0)
                $this->receiveService->update($id, ['status' => ReceiveStatus::PAID]);
            DB::commit();
            toastr('Ödəniş uğurla əlavə olundu');
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr($ex->getMessage(), 'error');
            return redirect()->back()->withInput($data);
        }
    }
}
