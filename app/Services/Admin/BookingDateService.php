<?php

namespace App\Services\Admin;

use App\Models\BookingDate;
use App\Models\BookingDateContainer;
use App\Models\Container;
use App\Models\Order;
use App\Services\MainService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BookingDateService extends MainService
{
    protected $model = BookingDate::class;

    public function getByIdWithContainers(int $id)
    {
        return $this->model::with([
            'containers' => function ($query) {
                $query->where('status', 1);
            },
            'containers.container'
        ])->find($id);
    }


    public function getByIdWithStatuses(int $id)
    {
        return $this->model::with('statuses')->find($id);
    }

    public function add_status(BookingDate $booking_date, $statuses, int $status_id): array
    {
        $existingStatusIds = $booking_date->statuses()->pluck('statuses.id')->toArray();
        $selectedIndex = $statuses->search(fn($status) => $status->id == $status_id);
        if ($selectedIndex === false) {
            return [
                'status' => 'error',
                'message' => 'Belə bir status mövcud deyil',
            ];
        }

        $canSync = true;

        for ($i = 0; $i < $selectedIndex; $i++) {
            if (!in_array($statuses[$i]->id, $existingStatusIds)) {
                $canSync = false;
                break;
            }
        }

        if ($canSync == false) {
            return [
                'status' => 'error',
                'message' => 'Əvvəlki statuslar tamamlanmayıb',
            ];
        }

        $booking_date->statuses()->syncWithoutDetaching($status_id);
        return [
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
        ];
    }

    public function get_status_info(BookingDate $booking_date, $statuses): array
    {
        $data = [];
        foreach ($statuses as $status) {
            $booking_date_status = $booking_date->statuses()->orderByDesc('id')->wherePivot('status_id', $status->id)->first();
            if ($booking_date_status) {
                $data[] = [
                    'name' => $status->name,
                    'date' => $booking_date_status->created_at->format('d.m.Y'),
                    'is_active' => 1,
                ];
            } else {
                $data[] = [
                    'name' => $status->name,
                    'date' => null,
                    'is_active' => 0
                ];
            }
        }

        return $data;
    }

    public function getByDate($date)
    {
        return $this->model::where('date', $date)->first();
    }

    public function getAllByDate($date)
    {
        return $this->model::where('date', $date)->get();
    }

    public function calculate_remainder_cbm(BookingDate $booking_date, $cbm)
    {
        return $booking_date->remainder_cbm - $cbm;
    }

    public function set_remainder_cbm(BookingDate $booking_date, $cbm)
    {
        $remainder_cbm = $this->calculate_remainder_cbm($booking_date, $cbm);
        $container_size = $booking_date->total_cbm / $booking_date->count;
        $remainder_count = ceil($remainder_cbm / $container_size);
        $this->update($booking_date->id, [
            'remainder_count' => $remainder_count,
            'remainder_cbm' => $remainder_cbm,
        ]);
    }

    public function get_booking_container(BookingDate $booking_date, int $container_id): BookingDateContainer|null
    {
        return $booking_date->containers()->where('container_id', $container_id)->first();
    }

    public function get_containers(BookingDate $booking_date)
    {
        return $booking_date->containers()->where('status', 1)->get();
    }

    public function add_check(BookingDate $booking_date, array $data): void
    {
        $container_ids = isset($data['container_ids']) ? $data['container_ids'] : [];
        foreach ($container_ids as $container_id) {
            $booking_date_container = $this->get_booking_container($booking_date, $container_id);
            if (is_null($booking_date_container))
                continue;
            $booking_date_container->update(['status' => 0, 'container_check_reason_id' => $data['container_check_reason_id'], 'note' => $data['note']]);
        }
    }

    public function get_bookings()
    {
        return $this->model::select('date')->groupBy('date')->get();
    }

    public function delete_containers(BookingDate $bookingDate, int $container_id)
    {
        return BookingDateContainer::where('status', 1)
            ->where('container_id', $container_id)
            ->delete();
    }

    public function add_payment(BookingDate $booking_date, array $data): array
    {
        if ($data['price'] > $booking_date->remainder) {
            return [
                'status' => 'error',
                'message' => 'Daxil edilən qiymət ödəmədən qalan qalıqdan çoxdur',
            ];
        }

        $booking_date->payments()->create($data);

        return [
            'status' => 'success',
            'message' => 'Ödəniş uğurla həyata keçirildi',
        ];
    }

    public function get_booking_dates()
    {
        return $this->model::pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('d.m.Y');
            })
            ->toArray();
    }

    public function import_bookings(Request $request)
    {
        $file = $request->file('file');
        $real_path = $file->getRealPath();
        $spreedSheet = IOFactory::load($real_path);
        $sheet = $spreedSheet->getActiveSheet();
        for ($i = 1; $i < $sheet->getHighestRow(); $i++) {
            $code = $sheet->getCell('A' . $i)->getValue();
            $container_code = $sheet->getCell('B' . $i)->getValue();
            $date = Date::excelToDateTimeObject($sheet->getCell('C' . $i)->getValue());
            $order = Order::where('code', $code)->first();
            $container = Container::where('code', $container_code)->first();
            $booking_date = BookingDate::where('date', $date)->first();
        }
    }
}
