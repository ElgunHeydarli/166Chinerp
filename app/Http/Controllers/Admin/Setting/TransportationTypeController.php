<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\TransportationTypeRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\TransportationServiceService;
use App\Services\Admin\Setting\TransportationTypeService;
use Illuminate\Http\Request;

class TransportationTypeController extends Controller
{
    use Sortable;

    public function __construct(
        public TransportationTypeService $transportationTypeService,
        public TransportationServiceService $transportationServiceService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportation_types = $this->transportationTypeService->getAll();
        return view('back.pages.setting.transportation-type.index', compact('transportation_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.transportation-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportationTypeRequest $request)
    {
        $data = $request->validated();
        $this->transportationTypeService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.transportation-type.index');
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
        $transportation_type = $this->transportationTypeService->getById($id);
        return view('back.pages.setting.transportation-type.edit', compact('transportation_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportationTypeRequest $request, string $id)
    {
        $data = $request->validated();
        $this->transportationTypeService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.transportation-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->transportationTypeService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.transportation-type.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->transportationTypeService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->transportationTypeService, $request->get('sorted_ids', []));
        return response($response);
    }

    public function get_transportation_services(int $id)
    {
        $transportation_services = $this->transportationServiceService->get_transportation_services($id);
        if (count($transportation_services) == 0) {
            return response([
                'status' => 'error',
                'message' => 'Məlumat tapılmadı',
            ]);
        }

        return response([
            'status' => 'success',
            'data' => $transportation_services,
        ]);
    }
}
