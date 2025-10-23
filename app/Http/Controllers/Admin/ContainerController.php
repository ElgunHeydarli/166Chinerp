<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContainerStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContainerEditRequest;
use App\Http\Requests\Admin\ContainerImageRequest;
use App\Http\Requests\Admin\ContainerRejectRequest;
use App\Http\Requests\Admin\ContainerRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\ContainerService;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\RejectReasonService;
use App\Services\Admin\VendorService;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public ContainerService $containerService,
        public CurrencyService $currencyService,
        public ContainerTypeService $containerTypeService,
        public VendorService $vendorService,
        public RejectReasonService $rejectReasonService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('Yeni Konteynerlər page');
        $containers = $this->containerService->filter($request);
        $reject_reasons = $this->rejectReasonService->getAll();
        return view('back.pages.container.index', compact('containers', 'reject_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Yeni Konteynerlər page-Sifariş yarat');
        $vendors = $this->vendorService->getAll();
        $currencies = $this->currencyService->getActive();
        $container_types = $this->containerTypeService->getAll();
        return view('back.pages.container.create', compact('vendors', 'currencies', 'container_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContainerRequest $request)
    {
        $this->authorize('Yeni Konteynerlər page-Sifariş yarat');
        $data = $request->validated();
        if ($request->hasFile('images'))
            $data['images'] = $this->fileUpload($request->file('images'), 'containers');
        $this->containerService->addMultipleContainers($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.container.index');
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
        $this->authorize('Yeni Konteynerlər page - Əməliyyatlar-Düzəliş et');
        $container = $this->containerService->getById($id);
        $container_types = $this->containerTypeService->getAll();
        $vendors = $this->vendorService->getAll();
        $currencies = $this->currencyService->getActive();
        return view('back.pages.container.edit', compact('container', 'container_types', 'currencies', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContainerEditRequest $request, string $id)
    {
        $this->authorize('Yeni Konteynerlər page - Əməliyyatlar-Düzəliş et');
        $data = $request->validated();
        $container = $this->containerService->getById($id);
        if (!is_null($data['code']))
            $data['status'] = ContainerStatus::ACCEPTED;
        $this->containerService->update($id, $data);
        if ($request->hasFile('images')) {
            $data['images'] = $this->fileUpload($request->file('images'), 'containers');
            $this->containerService->add_images($container, $data['images']);
        }
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.container.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('Bütün Konteynerlər page - Əməliyyatlar-Sil');
        $this->containerService->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi',
        ]);
    }

    public function add_container(Request $request)
    {
        $vendors = $this->vendorService->getAll();
        $container_types = $this->containerTypeService->getAll();
        $currencies = $this->currencyService->getActive();
        $counter = $request->get('counter', 1);
        $view = view('back.pages.container.section.add-new-container', compact('container_types', 'vendors', 'currencies', 'counter'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    public function accept(int $id)
    {
        $this->containerService->update($id, [
            'status' => ContainerStatus::ACCEPTED,
        ]);

        toastr('Konteyner təsdiqləndi');
        return redirect()->back();
    }

    public function reject(int $id, ContainerRejectRequest $request)
    {
        $data = $request->validated();
        $response = $this->containerService->reject($id, $data);
        toastr($response['message'], $response['status']);
        return redirect()->back();
    }

    public function add_images(int $id, ContainerImageRequest $request)
    {
        $this->authorize('Yeni Konteynerlər page-Konteyner şəkilləri Upload');
        $container = $this->containerService->getById($id);
        $data = $request->validated();
        if ($request->hasFile('images')) {
            $data['images'] = $this->fileUpload($request->file('images'), 'containers');
            $this->containerService->add_images($container, $data['images']);
            toastr('Konteyner şəkilləri uğurla yükləndi');
        }
        return redirect()->back();
    }

    function filter(Request $request)
    {
        try {
            $containers = $this->containerService->filter($request);
            $reject_reasons = $this->rejectReasonService->getAll();
            $view = view('back.pages.container.section.filter', compact('containers', 'reject_reasons'))->render();
            return response([
                'status' => 'success',
                'view' => $view,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx']]);
        $response = $this->containerService->import($request);
        toastr($response['message'], $response['status']);
        return redirect()->back();
    }
}
