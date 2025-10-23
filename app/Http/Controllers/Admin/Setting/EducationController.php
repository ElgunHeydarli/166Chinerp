<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\EducationRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\EducationService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    use Sortable;

    public function __construct(public EducationService $educationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = $this->educationService->getAll();
        return view('back.pages.setting.education.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request)
    {
        $data = $request->validated();
        $this->educationService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.education.index');
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
        $education = $this->educationService->getById($id);
        return view('back.pages.setting.education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, string $id)
    {
        $data = $request->validated();
        $this->educationService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.education.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->educationService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.education.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->educationService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->educationService, $request->get('sorted_ids', []));
        return response($response);
    }
}
