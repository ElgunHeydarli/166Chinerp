<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AboutBookingDateRequest;
use App\Services\Admin\Setting\AboutBookingDateService;
use Illuminate\Http\Request;

class AboutBookingDateController extends Controller
{
    public function __construct(public AboutBookingDateService $aboutBookingDateService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about_booking_dates = $this->aboutBookingDateService->getAll();
        return view('back.pages.setting.about-booking-date.index', compact('about_booking_dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.setting.about-booking-date.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutBookingDateRequest $request)
    {
        $data = $request->validated();
        $this->aboutBookingDateService->create($data);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.about-booking-date.index');
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
        $about_booking_date = $this->aboutBookingDateService->getById($id);
        return view('back.pages.setting.about-booking-date.edit', compact('about_booking_date'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutBookingDateRequest $request, string $id)
    {
        $data = $request->validated();
        $this->aboutBookingDateService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.about-booking-date.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->aboutBookingDateService->delete($id);
        toastr('Məlumat silindi');
        return redirect()->route('admin.about-booking-date.index');
    }

    public function change_status(int $id, Request $request)
    {
        $this->aboutBookingDateService->update($id, ['status' => $request->get('status')]);
        return response(['status' => 'success', 'message' => 'Status dəyişdirildi']);
    }
}
