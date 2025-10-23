<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CountryRequest;
use App\Http\Traits\Sortable;
use App\Services\Admin\Setting\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use Sortable;

    public function __construct(public CountryService $countryService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = $this->countryService->getAll();
        return view('back.pages.setting.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        $this->countryService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.country.index');
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
        $country = $this->countryService->getById($id);
        return view('back.pages.setting.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        $data = $request->validated();
        $this->countryService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->countryService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.country.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->countryService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }

    public function sort(Request $request)
    {
        $response = $this->sort_elements($this->countryService, $request->get('sorted_ids', []));
        return response($response);
    }
}
