<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\UserPayroll\CreateRequest;
use App\Http\Requests\Admin\Account\UserPayroll\EditRequest;
use App\Http\Requests\Admin\Account\UserPayroll\PaymentRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\Account\UserPayrollService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SalaryManagementController extends Controller
{
    use FileUploadTrait;
    public function __construct(
        public UserService $userService,
        public CurrencyService $currencyService,
        public UserPayrollService $userPayrollService,
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_payrolls = $this->userPayrollService->filter($request);
        return view('back.pages.account.salary-management.index', compact('user_payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->getActiveUsers();
        $currencies = $this->currencyService->getActive();
        return view('back.pages.account.salary-management.create', compact('users', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('bank_file'))
            $data['bank_file'] = $this->fileUpload($request->file('bank_file'), 'payroll');
        if ($request->hasFile('cash_file'))
            $data['cash_file'] = $this->fileUpload($request->file('cash_file'), 'payroll');
        $this->userPayrollService->addMultipleData($data);
        toastr('Toplu ödəmə əlavə olundu');
        return redirect()->route('admin.salary-management.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_payroll = $this->userPayrollService->getById($id);
        return view('back.pages.account.salary-management.detail', compact('user_payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_payroll = $this->userPayrollService->getById($id);
        $currencies = $this->currencyService->getActive();
        return view('back.pages.account.salary-management.edit', compact('currencies', 'user_payroll'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        $data = $request->validated();
        $user_payroll = $this->userPayrollService->getById($id);
        if ($request->hasFile('bank_file')) {
            $this->fileDelete($user_payroll->bank_file);
            $data['bank_file'] = $this->fileUpload($request->file('bank_file'), 'payroll');
        }
        if ($request->hasFile('cash_file')) {
            $this->fileDelete($user_payroll->cash_file);
            $data['cash_file'] = $this->fileUpload($request->file('cash_file'), 'payroll');
        }

        $this->userPayrollService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.salary-management.index');
    }

    public function payment(int $id)
    {
        $user_payroll = $this->userPayrollService->getById($id);
        $currencies = $this->currencyService->getActive();
        return view('back.pages.account.salary-management.payment', compact('user_payroll', 'currencies'));
    }

    public function pay(int $id, PaymentRequest $request)
    {
        $data = $request->validated();
        $user_payroll = $this->userPayrollService->getById($id);
        $data['status'] = 1;
        if (isset($data['has_advance'])) {
            $user_payroll_advance = $this->userPayrollService->add_advance($user_payroll, $data);
            if ($request->hasFile('advance_file')) {
                $data['files'] = $this->fileUpload($request->file('advance_file'), 'payroll');
                $this->userPayrollService->add_files($user_payroll_advance, $data['files']);
            }
        }

        $this->userPayrollService->update($id, $data);
        toastr('Ödəniş uğurla həyata keçirildi');
        return redirect()->route('admin.salary-management.index');
    }

    public function filter(Request $request)
    {
        $user_payrolls = $this->userPayrollService->filter($request);
        $view = view('back.pages.account.salary-management.filter', compact('user_payrolls'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }
}
