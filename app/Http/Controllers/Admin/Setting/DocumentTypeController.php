<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\DocumentTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\DocumentTypeService;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    use Sortable;

    public function __construct(public DocumentTypeService $documentTypeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_types = $this->documentTypeService->getAll();
        return view('back.pages.setting.document-type.index', compact('document_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.document-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentTypeRequest $request)
    {
        $data = $request->validated();
        $this->documentTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.document-type.index');
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
        $document_type = $this->documentTypeService->getById($id);
        return view('back.pages.setting.document-type.edit', compact('document_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->documentTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.document-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->documentTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.document-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->documentTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->documentTypeService, $request->get('sorted_ids', []));
        return response($response);
    }
}
