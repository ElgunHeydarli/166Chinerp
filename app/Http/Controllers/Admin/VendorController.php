<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CustomerType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VendorRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    use FileUploadTrait;

    public function __construct(public VendorService $vendorService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Vendor idarəetməsi page');
        $vendors = $this->vendorService->getAll();
        $customer_types = CustomerType::cases();
        return view('back.pages.vendor.index', compact('vendors', 'customer_types'));
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
    public function store(VendorRequest $request)
    {
        $this->authorize('Vendor idarəetməsi page-Add vendor');
        $data = $request->validated();
        $data['vendor_id'] = $this->vendorService->generate_vendor_id();
        $vendor = $this->vendorService->create($data);
        if ($request->hasFile('file')) {
            $this->vendorService->add_file($vendor, $this->fileUpload($request->file('file'), 'vendors'));
        }
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('Vendor idarəetməsi page-Əməliyyatlar-Bax');
        $vendor = $this->vendorService->getById($id);
        $view = view('back.pages.vendor.section.detail-vendor-modal', compact('vendor'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('Vendor idarəetməsi page-Əməliyyatlar-Düzəlişə göndər');
        $vendor = $this->vendorService->getById($id);
        $view = view('back.pages.vendor.section.edit-vendor-modal', compact('vendor'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, string $id)
    {
        $this->authorize('Vendor idarəetməsi page-Əməliyyatlar-Düzəlişə göndər');
        $data = $request->validated();
        $vendor = $this->vendorService->getById($id);
        if ($request->hasFile('file')) {
            $this->vendorService->add_file($vendor, $this->fileUpload($request->file('file'), 'vendors'));
        }
        $this->vendorService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status(int $id, Request $request)
    {
        $this->authorize('Vendor idarəetməsi page-Status');
        $this->vendorService->update($id, ['status' => $request->get('status')]);
        return response([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
        ]);
    }
}
