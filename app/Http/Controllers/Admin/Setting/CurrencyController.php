<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CurrencyRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    use Sortable;

    public function __construct(public CurrencyService $currencyService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->currencyService->getAll();
        return view('back.pages.setting.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequest $request)
    {
        $data = $request->validated();
        $this->currencyService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.currency.index');
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
        $currency = $this->currencyService->getById($id);
        return view('back.pages.setting.currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyRequest $request, string $id)
    {
        $data = $request->validated();
        $this->currencyService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.currency.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->currencyService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.currency.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->currencyService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->currencyService, $request->get('sorted_ids', []));
        return response($response);
    }
}
