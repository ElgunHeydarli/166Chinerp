<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ExpenseCategoryRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\ExpenseCategoryService;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    use Sortable;

    public function __construct(
        public ExpenseCategoryService $expenseCategoryService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_categories = $this->expenseCategoryService->getAll();
        return view('back.pages.setting.expense-category.index', compact('expense_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.expense-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseCategoryRequest $request)
    {
        $data = $request->validated();
        $this->expenseCategoryService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.expense-category.index');
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
        $expense_category = $this->expenseCategoryService->getById($id);
        return view('back.pages.setting.expense-category.edit', compact('expense_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $this->expenseCategoryService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.expense-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->expenseCategoryService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.expense-category.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->expenseCategoryService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->expenseCategoryService, $request->get('sorted_ids', []));
        return response($response);
    }

    public function get_sub_categories(int $id)
    {
        $expense_category = $this->expenseCategoryService->getById($id);
        $sub_categories = $expense_category->sub_categories;
        return response([
            'status' => 'success',
            'data' => $sub_categories,
        ]);
    }
}
