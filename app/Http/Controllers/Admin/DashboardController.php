<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Artisan;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Receive;
use App\Models\UserPayroll;
use App\Models\ExpensePayment;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $todayExpenses = Expense::whereDate('created_at', $today)->sum('total_price');
        $todayIncomes = Receive::whereDate('created_at', $today)->sum('total_price');
        $monthlyPayrolls = UserPayroll::whereMonth('created_at', $today->month)->count();
        $pendingVendorPayments = ExpensePayment::sum('amount');
        $customerCount = count(Customer::groupBy('name')->select('name')->get());

        $orderCounts = [
            'all' => Order::count(),
            'draft' => Order::where('status', 'draft')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'in_progress' => Order::where('status', 'execute')->count(),
            'rejected' => Order::where('status', 'canceled')->count(), // statusun səndə canceled-dısa
            'completed' => Order::where('status', 'finished')->count(),
            'awaiting_price' => Order::where('status', 'awaiting_price')->count(), // varsa
        ];

        return view('back.pages.index', compact(
            'todayExpenses',
            'todayIncomes',
            'monthlyPayrolls',
            'pendingVendorPayments',
            'orderCounts',
            'customerCount',
        ));
    }
}
