<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Services\Admin\Account\UserPayrollService;
use Illuminate\Http\Request;

class BulkPaymentController extends Controller
{
    public function __construct(public UserPayrollService $userPayrollService)
    {

    }

    public function index(Request $request)
    {
        $user_payrolls = $this->userPayrollService->filter($request);
        return view('back.pages.account.bulk-payment.index', compact('user_payrolls'));
    }

    public function filter(Request $request)
    {
        $user_payrolls = $this->userPayrollService->filter($request);
        $view = view('back.pages.account.bulk-payment.section.filter', compact('user_payrolls'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }
}
