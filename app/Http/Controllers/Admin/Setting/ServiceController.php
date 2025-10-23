<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\ServiceRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    use Sortable;

    public function __construct(public ServiceService $serviceService) {}

    /**
     * Display a listing of the reservice.
     */
    public function index()
    {
        $services = $this->serviceService->getAll();
        return view('back.pages.setting.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new reservice.
     */
    public function create()
    {
        return view('back.pages.setting.service.create');
    }

    /**
     * Store a newly created reservice in storage.
     */
    public function store(ServiceRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $service = $this->serviceService->create($data);
            if (isset($data['detail_name'])) $this->serviceService->add_details($service, $data);
            DB::commit();
            toastr('Məlumat əlavə olundu');
            return redirect()->route('admin.service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified reservice.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified reservice.
     */
    public function edit(string $id)
    {
        $service = $this->serviceService->getById($id);
        return view('back.pages.setting.service.edit', compact('service'));
    }

    /**
     * Update the specified reservice in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $data = $request->validated();
        $this->serviceService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified reservice from storage.
     */
    public function destroy(string $id)
    {
        $this->serviceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.service.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->serviceService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->serviceService, $request->get('sorted_ids', []));
        return response($response);
    }
}
