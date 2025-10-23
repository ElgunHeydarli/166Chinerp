<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\TransportationRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\TransportationService;
use App\Services\Admin\Setting\TransportationServiceService;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    use Sortable;

    public function __construct(
        public TransportationService $transportationService,
        public TransportationServiceService $transportationServiceService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportations = $this->transportationService->getAll();
        return view('back.pages.setting.transportation.index', compact('transportations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportation_services = $this->transportationServiceService->getAll();
        return view('back.pages.setting.transportation.create', compact('transportation_services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportationRequest $request)
    {
        $data = $request->validated();
        $this->transportationService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.transportation.index');
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
        $transportation = $this->transportationService->getById($id);
        $transportation_services = $this->transportationServiceService->getAll();
        return view('back.pages.setting.transportation.edit', compact('transportation', 'transportation_services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportationRequest $request, string $id)
    {
        $data = $request->validated();
        $this->transportationService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.transportation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->transportationService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.transportation.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->transportationService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->transportationService, $request->get('sorted_ids', []));
        return response($response);
    }
}
