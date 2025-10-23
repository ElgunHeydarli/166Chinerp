<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderExpenseRequest;
use App\Services\Admin\OrderService;
use App\Services\Admin\Setting\ExpenseTypeService;
use App\Services\Admin\Setting\PaymentTypeService;
use App\Services\Admin\VendorService;
use Illuminate\Http\Request;

class OrderExpenseController extends Controller
{

    public function __construct(
        public OrderService $orderService,
        public PaymentTypeService $paymentTypeService,
        public ExpenseTypeService $expenseTypeService,
        public VendorService $vendorService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = $this->orderService->getById($id);
        $vendors = $this->vendorService->getAll();
        $payment_types = $this->paymentTypeService->getAll();
        $expense_types = $this->expenseTypeService->getAll();
        $accounts = Account::all(); // ✅ hesablar siyahısı

        return view('back.pages.order-expense.create', compact(
            'order',
            'vendors',
            'payment_types',
            'expense_types',
            'accounts' // ✅ view-ə ötürülür
        ));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OrderExpenseRequest $request, string $id)
    {
        $data = $request->validated();

        // ✅ Qalıq borc hesablanır
        $data['remainder'] = ($data['total_price'] ?? 0) - ($data['pay_price'] ?? 0);

        // ✅ Sifarişi gətir
        $order = $this->orderService->getById($id);

        // ✅ Xərci sifarişə əlavə et
        $this->orderService->add_expenses($order, $data);

        // ✅ Hesab məlumatlarını tap və jurnal yazısına daxil et
        $accountNumber = '2002';
        $accountName = 'Vendor borcunun azaldılması';

        if (!empty($data['account_id'])) {
            $account = Account::find($data['account_id']);
            if ($account) {
                $accountNumber = $account->account_number ?? '2002';
                $accountName = $account->account_name ?? $accountName;
            }
        }

        // ✅ Jurnal yazısı əlavə et
        JournalEntry::create([
            'journal_id' => $order->id,
            'operation_date' => now(),
            'debit_account_number' => '5000', // xərc hesabı
            'debit_account_name' => $data['expense_type'] ?? 'Xərc',
            'debit_amount' => $data['total_price'],
            'credit_account_number' => $accountNumber,
            'credit_account_name' => $accountName,
            'credit_amount' => $data['pay_price'],
            'currency' => $data['currency'] ?? 'AZN',
            'description' => $data['note'] ?? 'Sifariş üzrə xərc əlavə olundu',
        ]);

        toastr('✅ Xərc əlavə olundu və jurnal yazısı yaradıldı');
        return redirect()->back();
    }
    public function destroy(string $id)
    {
    }
}
