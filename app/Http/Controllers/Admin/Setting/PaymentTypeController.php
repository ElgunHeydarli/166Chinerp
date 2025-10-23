<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\PaymentTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\PaymentTypeService;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    use Sortable;

    public function __construct(public PaymentTypeService $paymentTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_types = $this->paymentTypeService->getAll();
        return view('back.pages.setting.payment-type.index', compact('payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.payment-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentTypeRequest $request)
    {
        $data = $request->validated();
        $this->paymentTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.payment-type.index');
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
        $payment_type = $this->paymentTypeService->getById($id);
        return view('back.pages.setting.payment-type.edit', compact('payment_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->paymentTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.payment-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.payment-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->paymentTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->paymentTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
