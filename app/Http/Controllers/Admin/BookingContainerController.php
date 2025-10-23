<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingDatePaymentRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\BookingDateService;
use App\Services\Admin\Setting\CurrencyService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingContainerController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public BookingDateService $bookingDateService,
        public CurrencyService $currencyService,
    ) {
    }

    public function index()
    {
        $this->authorize('Konteyner rezervasiyası page');
        $bookings = $this->bookingDateService->get_bookings();
        return view('back.pages.booking-container.index', compact('bookings'));
    }

    public function detail($date)
    {
        $this->authorize('Konteyner rezervasiyası page-Bax');
        $booking_date = Carbon::createFromFormat('Ymd', $date)->format('Y-m-d');
        $booking_dates = $this->bookingDateService->getAllByDate($booking_date);
        $currencies = $this->currencyService->getActive();
        return view('back.pages.booking-container.detail', compact('booking_dates', 'currencies'));
    }

    public function change_status(int $id, Request $request)
    {
        $this->authorize('Konteyner rezervasiyası page-Bax-Status');
        try {
            $this->bookingDateService->update($id, ['status' => $request->get('status')]);
            return response([
                'status' => 'success',
                'message' => 'Status uğurla dəyişdirildi',
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function pay(int $id, BookingDatePaymentRequest $request)
    {
        $this->authorize('Konteyner rezervasiyası page-Bax-Ödə');
        $booking_date = $this->bookingDateService->getById($id);
        $data = $request->validated();
        if ($request->hasFile('file'))
            $data['file'] = $this->fileUpload($request->file('file'), 'booking_dates');
        $response = $this->bookingDateService->add_payment($booking_date, $data);
        if ($response['status'] == 'success') {
            $this->bookingDateService->update($id, ['remainder' => $booking_date->total_price - $data['price']]);
        }
        toastr($response['message'], $response['status']);
        return redirect()->back();
    }
}
