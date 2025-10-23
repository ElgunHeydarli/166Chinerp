<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Services\Admin\Account\UserPayrollService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function __construct(public UserPayrollService $userPayrollService)
    {

    }

    public function index(Request $request)
    {
        $user_payrolls = $this->userPayrollService->get_group_by_date($request);
        return view('back.pages.account.payment-history.index', compact('user_payrolls'));
    }

    public function detail($date)
    {
        $last_payment_date = Carbon::createFromFormat('Ymd', $date)->format('Y-m-d');
        $user_payrolls = $this->userPayrollService->get_by_date($last_payment_date);
        return view('back.pages.account.payment-history.detail', compact('user_payrolls'));
    }

    public function filter(Request $request)
    {
        $user_payrolls = $this->userPayrollService->get_group_by_date($request);
        $view = view('back.pages.account.payment-history.section.filter', compact('user_payrolls'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }
}
