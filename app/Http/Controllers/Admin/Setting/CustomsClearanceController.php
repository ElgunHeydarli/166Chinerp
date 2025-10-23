<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CustomsClearanceRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CustomsClearanceService;
use Illuminate\Http\Request;

class CustomsClearanceController extends Controller
{
    use Sortable;

    public function __construct(public CustomsClearanceService $customsClearanceService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customs_clearances = $this->customsClearanceService->getAll();
        return view('back.pages.setting.customs-clearance.index', compact('customs_clearances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.customs-clearance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomsClearanceRequest $request)
    {
        $data = $request->validated();
        $this->customsClearanceService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.customs-clearance.index');
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
        $customs_clearance = $this->customsClearanceService->getById($id);
        return view('back.pages.setting.customs-clearance.edit', compact('customs_clearance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomsClearanceRequest $request, string $id)
    {
        $data = $request->validated();
        $this->customsClearanceService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.customs-clearance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->customsClearanceService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.customs-clearance.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->customsClearanceService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->customsClearanceService, $request->get('sorted_ids', []));
        return response($response);
    }
}
