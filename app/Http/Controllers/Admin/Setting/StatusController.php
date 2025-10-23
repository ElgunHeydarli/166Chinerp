<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\StatusRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use Sortable;

    public function __construct(public StatusService $statusService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = $this->statusService->getAll();
        return view('back.pages.setting.status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request)
    {
        $data = $request->validated();
        $this->statusService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.status.index');
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
        $status = $this->statusService->getById($id);
        return view('back.pages.setting.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusRequest $request, string $id)
    {
        $data = $request->validated();
        $this->statusService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.status.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->statusService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.status.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->statusService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->statusService, $request->get('sorted_ids', []));
        return response($response);
    }
}
