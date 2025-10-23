<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CustomerType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Services\Admin\CustomerService;
use App\Services\Admin\Setting\SourceService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(public CustomerService $customerService, public SourceService $sourceService) {}

    public function index()
    {
        $customers = $this->customerService->getByType(CustomerType::LEGAL);
        return view('back.pages.company.index', compact('customers'));
    }

    public function create()
    {
        $sources = $this->sourceService->getAll();
        return view('back.pages.company.create', compact('sources'));
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        $this->customerService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.company.index');
    }

    public function edit(int $id)
    {
        $customer = $this->customerService->getById($id);
        $sources = $this->sourceService->getAll();
        return view('back.pages.company.edit', compact('customer', 'sources'));
    }

    public function update(int $id, CustomerRequest $request)
    {
        $data = $request->validated();
        $this->customerService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.company.index');
    }

    public function destroy(int $id)
    {
        $this->customerService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.company.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->customerService->update($id, ['status' => $request->get('status')]);
        return response([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
        ]);
    }
}
