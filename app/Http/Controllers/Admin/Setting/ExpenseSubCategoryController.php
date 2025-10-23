<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ExpenseSubCategoryRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\ExpenseCategoryService;
use App\Services\Admin\Setting\ExpenseSubCategoryService;
use Illuminate\Http\Request;

class ExpenseSubCategoryController extends Controller
{
    use Sortable;

    public function __construct(
        public ExpenseSubCategoryService $expenseSubCategoryService,
        public ExpenseCategoryService $expenseCategoryService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_sub_categories = $this->expenseSubCategoryService->getAll();
        return view('back.pages.setting.expense-sub-category.index', compact('expense_sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expense_categories = $this->expenseCategoryService->getAll();
        return view('back.pages.setting.expense-sub-category.create', compact('expense_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseSubCategoryRequest $request)
    {
        $data = $request->validated();
        $this->expenseSubCategoryService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.expense-sub-category.index');
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
        $expense_sub_category = $this->expenseSubCategoryService->getById($id);
        $expense_categories = $this->expenseCategoryService->getAll();
        return view('back.pages.setting.expense-sub-category.edit', compact('expense_sub_category', 'expense_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseSubCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $this->expenseSubCategoryService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.expense-sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->expenseSubCategoryService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.expense-sub-category.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->expenseSubCategoryService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->expenseSubCategoryService, $request->get('sorted_ids', []));
        return response($response);
    }
}
