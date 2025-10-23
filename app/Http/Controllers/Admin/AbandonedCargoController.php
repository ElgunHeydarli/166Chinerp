<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderMixFull;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AbandonedCargoEditRequest;
use App\Http\Requests\Admin\AbandonedCargoRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\AbandonedCargoService;
use App\Services\Admin\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbandonedCargoController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public AbandonedCargoService $abandonedCargoService,
        public OrderService $orderService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Sahibsiz yüklər page');
        $abandoned_cargos = $this->abandonedCargoService->getAllByStatus('pending');
        $orders = $this->orderService->getOrdersByStatus(OrderStatus::EXECUTE);
        return view('back.pages.abandoned-cargo.index', compact('abandoned_cargos','orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AbandonedCargoRequest $request)
    {
        $this->authorize('Sahibsiz yüklər page -Sahibsiz yük əlavə et');
        $data = $request->validated();
        if ($request->hasFile('image')) $data['image'] = $this->fileUpload($request->file('image'), 'abandoned-cargos');
        if ($request->hasFile('file')) $data['file'] = $this->fileUpload($request->file('file'), 'abandoned-cargos');
        $data['date'] = Carbon::createFromFormat('d.m.Y', $data['date']);
        $this->abandonedCargoService->create($data);

        toastr('Məlumat əlavə olundu');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AbandonedCargoEditRequest $request, string $id)
    {
        $this->authorize('Sahibsiz yüklər page-Təsdiq et');
        $data = $request->validated();
        $this->abandonedCargoService->update($id, $data);

        toastr('Yükünüz sifarişlərə əlavə olundu');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
