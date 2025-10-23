<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContainerPriceRequest;
use App\Services\Admin\ContainerPriceService;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\Admin\Setting\StationService;
use Illuminate\Http\Request;

class ContainerPriceController extends Controller
{
    public function __construct(
        public ContainerPriceService $containerPriceService,
        public StationService $stationService,
        public ContainerTypeService $containerTypeService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('Rezervasiya qiymətləri page');
        $container_prices = $this->containerPriceService->filter(
            $request->get('limit', 10),
            $request->get('container_type_id'),
            $request->get('station_id')
        );
        $stations = $this->stationService->getAll();
        $container_types = $this->containerTypeService->getAll();
        return view('back.pages.container-price.index', compact('container_prices', 'stations', 'container_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.container-price');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContainerPriceRequest $request)
    {
        $this->authorize('Rezervasiya qiymətləri page-Əlavə et');
        $data = $request->validated();
        $this->containerPriceService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.container-price.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $container_price = $this->containerPriceService->getByIdWithDetails($id);
        if (is_null($container_price)) {
            return response([
                'status' => 'error',
                'message' => 'Məlumat tapılmadı',
            ]);
        }
        return response([
            'status' => 'success',
            'data' => $container_price,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContainerPriceRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $this->containerPriceService->update($id, $data);
            return response([
                'status' => 'success',
                'message' => 'Qiymət yeniləndi',
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->containerPriceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.container-price.index');
    }

    public function filter(Request $request)
    {
        $container_prices = $this->containerPriceService->filter(
            $request->get('limit', 10),
            $request->get('container_type_id'),
            $request->get('station_id')
        );

        $view = view('back.pages.container-price.section.filter', compact('container_prices'))->render();

        return response([
            'status' => 'success',
            'view' => $view
        ]);
    }
}
