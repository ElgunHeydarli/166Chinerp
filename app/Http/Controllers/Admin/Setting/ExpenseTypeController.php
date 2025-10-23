<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ExpenseTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\ExpenseTypeService;
use App\Services\Admin\Setting\ServiceService;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    use Sortable;

    public function __construct(
        public ExpenseTypeService $expenseTypeService,
        public ServiceService $serviceService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense_types = $this->expenseTypeService->getAll();
        return view('back.pages.setting.expense-type.index', compact('expense_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = $this->serviceService->getActive();
        return view('back.pages.setting.expense-type.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseTypeRequest $request)
    {
        $data = $request->validated();
        $this->expenseTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.expense-type.index');
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
        $expense_type = $this->expenseTypeService->getById($id);
        $services = $this->serviceService->getActive();
        return view('back.pages.setting.expense-type.edit', compact('expense_type', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->expenseTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.expense-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->expenseTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.expense-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->expenseTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->expenseTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
