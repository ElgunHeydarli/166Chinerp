<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\PriceTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\PriceTypeService;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    use Sortable;

    public function __construct(public PriceTypeService $priceTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $price_types = $this->priceTypeService->getAll();
        return view('back.pages.setting.price-type.index', compact('price_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.price-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceTypeRequest $request)
    {
        $data = $request->validated();
        $this->priceTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.price-type.index');
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
        $price_type = $this->priceTypeService->getById($id);
        return view('back.pages.setting.price-type.edit', compact('price_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->priceTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.price-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->priceTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.price-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->priceTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->priceTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
