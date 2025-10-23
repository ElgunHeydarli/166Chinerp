<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\RejectReasonRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\RejectReasonService;
use Illuminate\Http\Request;

class RejectReasonController extends Controller
{
    use Sortable;

    public function __construct(public RejectReasonService $rejectReasonService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reject_reasons = $this->rejectReasonService->getAll();
        return view('back.pages.setting.reject-reason.index', compact('reject_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.reject-reason.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RejectReasonRequest $request)
    {
        $data = $request->validated();
        $this->rejectReasonService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.reject-reason.index');
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
        $reject_reason = $this->rejectReasonService->getById($id);
        return view('back.pages.setting.reject-reason.edit', compact('reject_reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RejectReasonRequest $request, string $id)
    {
        $data = $request->validated();
        $this->rejectReasonService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.reject-reason.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->rejectReasonService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.reject-reason.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->rejectReasonService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->rejectReasonService, $request->get('sorted_ids', []));
        return response($response);
    }
}
