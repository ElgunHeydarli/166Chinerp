<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\Expense\PayRequest;
use App\Http\Requests\Admin\Account\ExpenseRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\Account\ExpenseService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\ExpenseCategoryService;
use App\Services\Admin\Setting\ExpenseSubCategoryService;
use App\Services\Admin\VendorService;
use DB;
use Illuminate\Http\Request;



class ExpenseController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public ExpenseSubCategoryService $expenseSubCategoryService,
        public ExpenseCategoryService $expenseCategoryService,
        public CurrencyService $currencyService,
        public ExpenseService $expenseService,
        public VendorService $vendorService,
    ) {

    }

    public function index(Request $request)
    {
        $expenses = $this->expenseService->filter($request);
        return view('back.pages.account.expense.index', compact('expenses'));
    }

    public function create()
    {
        $currencies = $this->currencyService->getActive();
        $vendors = $this->vendorService->getAll();
        $expense_categories = $this->expenseCategoryService->getAll();
        $expense_sub_categories = $this->expenseSubCategoryService->getAll();

        $accounts = \App\Models\LedgerAccount::select('id', 'code', 'title')
            ->where('status', 1)
            ->get();

        return view('back.pages.account.expense.create', compact([
            'currencies',
            'vendors',
            'expense_categories',
            'expense_sub_categories',
            'accounts'
        ]));
    }


    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();

        // Remainder hesabla
        $data['pay_price'] = $data['pay_price'] ?? 0;
        $data['remainder'] = ($data['total_price'] ?? 0) - $data['pay_price'];

        // Expense yaradılır
        $expense = $this->expenseService->create($data);

        // Default hesab dəyərləri
        $accountNumber = '2002';
        $accountName = 'Vendor ödənişi';

        // Əgər account_id seçilibsə LedgerAccount-dan məlumat al
        if (!empty($data['account_id'])) {
            $ledger = \App\Models\LedgerAccount::find($data['account_id']);
            if ($ledger) {
                $accountNumber = $ledger->code ?? '2002';
                $accountName = $ledger->title ?? 'Vendor ödənişi';
            }
        }

        // Jurnal yazısı
        \App\Models\JournalEntry::create([
            'journal_id' => $expense->id,
            'operation_date' => now(),
            'debit_account_number' => '5000',
            'debit_account_name' => $data['expense_type'] ?? 'Xərc',
            'debit_amount' => $data['total_price'],
            'credit_account_number' => $accountNumber,
            'credit_account_name' => $accountName,
            'credit_amount' => $data['pay_price'],
            'currency' => $data['currency'] ?? 'AZN',
            'description' => $data['note'] ?? 'Xərc əlavə edildi',
        ]);

        toastr('Məlumat əlavə olundu və jurnal qeydi yaradıldı');
        return redirect()->route('admin.expense.index');
    }


    public function show(int $id)
    {
        $expense = $this->expenseService->getById($id);
        $currencies = $this->currencyService->getActive();
        return view('back.pages.account.expense.detail', compact('expense', 'currencies'));
    }

    public function edit(int $id)
    {
        $expense = $this->expenseService->getById($id);
        $currencies = $this->currencyService->getActive();
        $vendors = $this->vendorService->getAll();
        $expense_categories = $this->expenseCategoryService->getAll();
        $expense_sub_categories = $this->expenseSubCategoryService->getAll();
        return view('back.pages.account.expense.edit', compact([
            'expense',
            'vendors',
            'currencies',
            'expense_categories',
            'expense_sub_categories',
        ]));
    }

    public function update(int $id, ExpenseRequest $request)
    {
        $data = $request->validated();
        $this->expenseService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.expense.index');
    }

    public function destroy(int $id)
    {
        $this->expenseService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.expense.index');
    }

    public function filter(Request $request)
    {
        $expenses = $this->expenseService->filter($request);
        $view = view('back.pages.account.expense.section.filter', compact('expenses'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function pay(int $id, PayRequest $request)
    {
        $data = $request->validated();
        try {
            if ($request->hasFile('file'))
                $data['file'] = $this->fileUpload($request->file('file'), 'expenses');
            $expense = $this->expenseService->getById($id);
            DB::beginTransaction();
            $this->expenseService->add_payment($expense, $data);
            DB::commit();
            toastr('Ödəniş uğurla əlavə olundu');
            return redirect()->route('admin.expense.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr($ex->getMessage(), 'error');
            return redirect()->back()->withInput($data);
        }
    }
}
