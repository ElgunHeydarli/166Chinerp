<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ProductTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    use Sortable;

    public function __construct(public ProductTypeService $productTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_types = $this->productTypeService->getAll();
        return view('back.pages.setting.product-type.index', compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.product-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        $data = $request->validated();
        $this->productTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.product-type.index');
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
        $product_type = $this->productTypeService->getById($id);
        return view('back.pages.setting.product-type.edit', compact('product_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->productTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.product-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.product-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->productTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->productTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
