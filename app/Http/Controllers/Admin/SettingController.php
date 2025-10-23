<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingCreateRequest;
use App\Http\Requests\Admin\SettingEditRequest;
use App\Services\Admin\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(public SettingService $settingService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $settings = $this->settingService->filter($request);
        return view('back.pages.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingCreateRequest $request)
    {
        $data = $request->validated();
        $this->settingService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.setting.index');
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
        $setting = $this->settingService->getById($id);
        return view('back.pages.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingEditRequest $request, string $id)
    {
        $data = $request->validated();
        $this->settingService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->settingService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.setting.index');
    }

    public function filter(Request $request)
    {
        $settings = $this->settingService->filter($request);
        $view = view('back.pages.settings.section.filter', compact('settings'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }
}
