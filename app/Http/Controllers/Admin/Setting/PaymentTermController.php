<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\PaymentTermRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\PaymentTermService;
use Illuminate\Http\Request;

class PaymentTermController extends Controller
{
    use Sortable;

    public function __construct(public PaymentTermService $paymentTermService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_terms = $this->paymentTermService->getAll();
        return view('back.pages.setting.payment-term.index', compact('payment_terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.payment-term.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentTermRequest $request)
    {
        $data = $request->validated();
        $this->paymentTermService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.payment-term.index');
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
        $payment_term = $this->paymentTermService->getById($id);
        return view('back.pages.setting.payment-term.edit', compact('payment_term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentTermRequest $request, string $id)
    {
        $data = $request->validated();
        $this->paymentTermService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.payment-term.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentTermService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.payment-term.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->paymentTermService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->paymentTermService, $request->get('sorted_ids', []));
        return response($response);
    }
}
