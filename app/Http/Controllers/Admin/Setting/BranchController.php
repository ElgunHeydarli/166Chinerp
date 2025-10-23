<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\BranchRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\BranchService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use Sortable;

    public function __construct(public BranchService $branchService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = $this->branchService->getAll();
        return view('back.pages.setting.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $data = $request->validated();
        $this->branchService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.branch.index');
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
        $branch = $this->branchService->getById($id);
        return view('back.pages.setting.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, string $id)
    {
        $data = $request->validated();
        $this->branchService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.branch.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->branchService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.branch.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->branchService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->branchService, $request->get('sorted_ids', []));
        return response($response);
    }
}
