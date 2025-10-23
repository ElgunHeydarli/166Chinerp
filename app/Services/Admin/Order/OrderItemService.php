<?php

namespace App\Services\Admin\Order;

use App\Enums\ContainerStatus;
use App\Enums\OrderMixFull;
use App\Enums\OrderStatus;
use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Container;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Models\User;
use App\Services\Admin\BookingDateContainerService;
use App\Services\Admin\BookingDateService;
use App\Services\Admin\ContainerService;
use App\Services\MainService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrderItemService extends MainService
{
    protected $model = OrderItem::class;

    public function __construct(
        public BookingDateService $bookingDateService,
        public ContainerService $containerService,
        public BookingDateContainerService $bookDateContainerService,
    ) {
    }

    public function add_railway(OrderItem $order_items, string $file)
    {
        $railway_bill = $order_items->railway_bill;
        if (is_null($railway_bill)) {
            $railway_bill = $order_items->railway_bill()->create(['file' => $file]);
            $railway_bill->status_changes()->create([
                'file' => $file,
                'status' => 'Yükləndi',
            ]);
        } else {
            $railway_bill->update(['file' => $file, 'status' => 0]);
            $railway_bill->status_changes()->create([
                'file' => $file,
                'status' => 'Yenidən yükləndi',
            ]);
        }
    }

    public function add_declaration(OrderItem $order_items, string $file)
    {
        $declaration = $order_items->declaration;
        if (is_null($declaration))
            $declaration = $order_items->declaration()->create(['file' => $file]);
        else
            $declaration->update(['file' => $file]);
    }

    public function add_short_declaration(OrderItem $order_items, string $file)
    {
        $short_declaration = $order_items->short_declaration;
        if (is_null($short_declaration))
            $short_declaration = $order_items->short_declaration()->create(['file' => $file]);
        else
            $short_declaration->update(['file' => $file]);
    }

    public function change_railway_status(OrderItem $order_item, int $railway_status): array
    {
        $railway_bill = $order_item->railway_bill;
        $status = 'success';
        $message = '';
        if (is_null($railway_bill)) {
            $status = 'error';
            $message = 'Railway bill tapılmadı';
        }

        if ($railway_status == 1) {
            $message = 'Railway bill təsdiqləndi';
            $railway_bill->status_changes()->create([
                'file' => $railway_bill->file,
                'status' => 'Təsdiqləndi',
            ]);
        } else if ($railway_status == 2) {
            $message = 'Railway bill ləğv olundu';
            $railway_bill->status_changes()->create([
                'file' => $railway_bill->file,
                'status' => 'Ləğv olundu',
            ]);
        } else {
            $status = 'error';
            $message = 'Status doğru deyil';
        }

        if ($status == 'success')
            $railway_bill->update(['status' => $railway_status]);
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

    public function add_images(OrderItem $order_item, array $images)
    {
        foreach ($images as $image) {
            $order_item->images()->create([
                'image' => $image,
            ]);
        }
    }

    public function booking(OrderItem $order_item, array $data): array
    {
        $order_booking = $order_item->booking;
        $order = $order_item->order;
        $data['date'] = Carbon::createFromFormat('d.m.Y', $data['date']);
        $booking_date = $this->bookingDateService->getByDate($data['date']->format('Y-m-d'));
        $container = $this->containerService->getById($data['container_id']);
        $error_messages = [];
        if (is_null($order_booking)) {
            if (!is_null($booking_date)) {
                $booking_date_container = $this->bookDateContainerService->getData($booking_date->id, $data['container_id']);

                if (!is_null($booking_date_container)) {
                    $error_messages[] = "Bu konteyner artıq " . $booking_date_container->booking_date?->date?->format('d.m.Y') . " tarixinə rezervasiya olunmuşdur";
                }

                if ($order->mix_full == 'mix' || $order->mix_full == 'full') {
                    if (count($error_messages) > 0) {
                        return [
                            'status' => 'error',
                            'messages' => $error_messages,
                        ];
                    } else {
                        $remainder_cbm = $this->bookingDateService->calculate_remainder_cbm($booking_date, $order->cbm);
                        $empty_volume = $container->empty_volume - $order->cbm;
                        $packed_volume = $container->packed_volume + $order->cbm;
                        $this->containerService->update($data['container_id'], ['empty_volume' => $empty_volume, 'packed_volume' => $packed_volume]);
                        $this->bookingDateService->set_remainder_cbm($booking_date, $order_item->cbm);
                    }
                } else {
                    $booking_count = count(Booking::where('container_id', $data['container_id'])->get());
                    if ($booking_count == 3) {
                        $error_messages[] = 'Bu konteyner üçün rezerv olunacaq yerlər 3dən çox ola bilməz';
                    } else if ($booking_count == 2) {
                        if (count($error_messages) > 0) {
                            return [
                                'status' => 'error',
                                'messages' => $error_messages,
                            ];
                        } else {
                            $container = $this->containerService->getById($data['container_id']);
                            $empty_volume = $container->empty_volume - round($container->volume / 3 * 10) / 10;
                            $packed_volume = $container->packed_volume + round($container->volume / 3 * 10) / 10;
                            $this->bookingDateService->set_remainder_cbm($booking_date, $container->volume);
                        }
                    }
                }
                $booking = $order_item->booking;
                $booking_container = Booking::where('container_id', $data['container_id'])
                    ->where('date', '!=', $data['date'])
                    ->first();
                if (is_null($order_item->railway_bill))
                    $error_messages[] = 'Railway bill yüklənilməyib';
                if (!is_null($order_item->railway_bill) && $order_item->railway_bill->status != 1)
                    $error_messages[] = 'Railway bill statusu təsdiqlənməyib';
                if (is_null($order_item->declaration))
                    $error_messages[] = 'Decleation yüklənməyib';
                if (count($order_item->images) == 0)
                    $error_messages[] = 'Konteyner şəkilləri yüklənməyib';
                if ($order_item->order->mix_full == 'automobile' && empty($order_item->vin_code))
                    $error_messages[] = 'Vin kod daxil edilməyib';
                if (count($error_messages) > 0)
                    return [
                        'status' => 'error',
                        'messages' => $error_messages,
                    ];
                if (is_null($booking)) {
                    $order_item->booking()->create($data);
                } else {
                    $booking->update($data);
                }
                if (is_null($booking_date->containers()->where(['container_id' => $data['container_id'], 'status' => 1])->first())) {
                    $booking_date->containers()->create(['container_id' => $data['container_id']]);
                }
                return [
                    'status' => 'success',
                    'message' => 'Rezervasiya uğurla qeydə alınmışdır',
                ];
            } else {
                $error_messages[] = 'Bu tarixə qeydə alınmış rezervasiya yoxdur';
                return [
                    'status' => 'error',
                    'messages' => $error_messages,
                ];
            }
        } else {
            $error_messages[] = 'Bu sifariş artıq rezervasiya olunmuşdur';
            return [
                'status' => 'error',
                'messages' => $error_messages,
            ];
        }
    }

    public function change_status(OrderItem $order_item, OrderStatus $status)
    {
        $order_item->status_changes()->create([
            'status' => $status,
        ]);
    }

    public function filter(Request $request)
    {
        $sort_by = $request->get('sort_by');
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $status = $request->get('status');
        $type = $request->get('type');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $user = auth()->user();


        $query = OrderItem::query()
            ->join('orders as o', 'order_items.order_id', '=', 'o.id')
            ->join('users as us', 'us.id', '=', 'o.user_id')
            ->join('customers as c', 'c.id', '=', 'o.customer_id')
            ->leftJoin('order_factories as of', 'of.order_item_id', '=', 'order_items.id')
            ->leftJoin('factory_vin_codes as fvc', 'fvc.order_factory_id', '=', 'of.id')
            ->leftJoin('order_item_railway_bills as rwb', 'order_items.id', 'rwb.order_item_id')
            ->leftJoin('order_item_declarations as dec', 'dec.order_item_id', '=', 'order_items.id')
            ->leftJoin('order_item_short_declarations as sh_dec', 'sh_dec.order_item_id', '=', 'order_items.id')
            ->leftJoin('order_item_images as img', 'img.order_item_id', '=', 'order_items.id')
            ->leftJoin('order_item_status_changes as stc', 'stc.order_item_id', '=', 'order_items.id')
            ->leftJoin('bookings as b', 'b.order_item_id', '=', 'order_items.id')
            ->leftJoin('containers as con', 'con.id', '=', 'b.container_id')
            ->leftJoin('container_types as c_type', 'c_type.id', '=', 'o.container_type_id')
            ->leftJoin('order_item_warehouses as ow', 'ow.order_item_id', 'order_items.id')
            ->leftJoin('order_services as os', 'os.order_item_id', 'order_items.id')
            ->select([
                'o.id as order_id',
                'order_items.id as order_item_id',
                'o.code',
                'o.product_name',
                'us.id as user_id',
                'us.name as user_name',
                'c.id as customer_id',
                'c.name as customer_name',
                'c.type as customer_type',
                'c.company_name as company_name',
                DB::raw('GROUP_CONCAT(DISTINCT of.id) as order_factory_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT stc.id) as status_change_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT img.id) as image_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT fvc.vin_code) as vin_codes'),
                DB::raw('GROUP_CONCAT(os.id) as order_service_ids'),
                'o.apply_date',
                'o.created_at as order_date',
                'o.weight',
                'order_items.cbm',
                'o.price',
                'o.price_currency',
                'o.mix_full',
                'rwb.file as railway_bill',
                'rwb.status as railway_status',
                'dec.file as declaration',
                'sh_dec.file as short_declaration',
                'con.code as container_name',
                'b.date as booking_date',
                'order_items.status as order_status',
                'b.container_id as container_id',
                'order_items.handover',
                'ow.file as warehouse',
                'ow.arrival_date as arrival_date',
                'c_type.name as container_type',
            ])
            ->groupBy([
                'order_items.id',
                'o.id',
                'o.code',
                'us.id',
                'us.name',
                'c.id',
                'c.name',
                'o.apply_date',
                'o.weight',
                'o.price_currency',
                'order_items.cbm',
                'c.company_name',
                'c.type',
                'o.mix_full',
                'o.price',
                'rwb.file',
                'rwb.status',
                'sh_dec.file',
                'dec.file',
                'con.code',
                'b.date',
                'order_items.status',
                'b.container_id',
                'order_items.handover',
                'o.created_at',
                'ow.arrival_date',
                'ow.file',
                'o.product_name',
                'c_type.name',
            ]);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                return $q
                    ->where('o.code', 'like', "%$search%")
                    ->orWhere('c.name', 'like', "%$search%")
                    ->orWhere('con.code', 'like', "%$search%")
                    ->orWhere('us.name', 'like', "%$search%")
                    ->orWhere('o.price', 'like', "%$search%")
                    ->orWhere('o.weight', 'like', "%$search%")
                    ->orWhere('o.price', 'like', "%$search%")
                    ->orWhere('c.company_name', 'like', "%$search%")
                    ->orWhere('o.product_name', 'like', "%$search%")
                    ->orWhere('order_items.cbm', 'like', "%$search%");
            });
        }

        if (!$user->hasRole(['Admin', 'Operations manager', 'Documentations', 'Warehouse manager', 'Port relations', 'Collections'])) {
            $query->where('us.id', $user->id);
        }

        if (!is_null($type)) {
            $query->where('o.mix_full', $type);
        }

        if (!is_null($status)) {
            $query->where('order_items.status', $status);
        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('o.apply_date', [$start, $end]);
        }

        if (!is_null($sort_by)) {
            switch ($sort_by) {
                case 'name_asc':
                    $query->orderBy('c.name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('c.name', 'desc');
                    break;
                case 'old_to_new':
                    $query->orderBy('o.created_at', 'asc');
                    break;
                case 'new_to_old':
                    $query->orderBy('c.name', 'desc');
                    break;
                case 'apply_date':
                    $query->orderBy('o.apply_date', 'desc');
                    break;
                case 'booking_date':
                    $query->orderBy('b.date', 'desc');
                    break;
                default:
                    $query->orderBy('o.apply_date', 'desc');
                    break;
            }
        } else {
            $query->orderBy('o.apply_date', 'desc');
        }


        $order_items = $query->paginate($limit);
        return $order_items;
    }

    public function change_cbm(OrderItem $order_item, array $data)
    {
        $this->update($order_item->id, ['cbm' => $data['new_cbm']]);
        $order = $order_item->order;
        $order->update([
            'cbm' => $data['new_cbm'],
        ]);
    }

    public function divide_order(Order $order, array $data)
    {
        $order->items()->delete();
        foreach ($data['new_cbm'] as $cbm) {
            $order->items()->create([
                'cbm' => $cbm,
                'status' => $order->status,
            ]);
        }
    }

    public function add_warehouse(OrderItem $order_item, array $data)
    {
        $order_item_warehouse = $order_item->order_item_warehouse;
        if (is_null($order_item_warehouse))
            $order_item_warehouse = $order_item->order_item_warehouse()->create($data);
        else
            $order_item_warehouse->update($data);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $real_path = $file->getRealPath();
        $spreadSheet = IOFactory::load($real_path);
        $sheet = $spreadSheet->getActiveSheet();
        $row_count = $sheet->getHighestRow();
        for ($i = 2; $i < $row_count; $i++) {
            try {
                $code = rand(10, 99) . substr($sheet->getCell('A' . $i)->getValue(), 3);
                $user_name = $sheet->getCell('B' . $i)->getValue();
                $user_id = User::where('name', $user_name)->first()?->id;
                $customer_name = $sheet->getCell('C' . $i)->getValue();
                $customer_id = Customer::where(function ($q) use ($customer_name) {
                    return $q->where('name', $customer_name)
                        ->orWhere('company_name', $customer_name);
                })->first()?->id;
                $apply_date = Carbon::createFromFormat('d/m/Y', $sheet->getCell('E' . $i)->getValue());
                $product_type = $sheet->getCell('F' . $i)->getValue();
                if ($product_type == 1)
                    $mix_full = OrderMixFull::MIX;
                elseif ($product_type == 2)
                    $mix_full = OrderMixFull::FULL;
                else
                    $mix_full = OrderMixFull::AUTOMOBILE;

                $product_name = $sheet->getCell('G' . $i)->getValue();
                $price = $sheet->getCell('I' . $i)->getValue();
                $date = Carbon::createFromFormat('d.m.Y', $sheet->getCell('L' . $i)->getValue());
                $container_codes = explode(',', $sheet->getCell('M' . $i)->getValue());

                $order = Order::where('code', $code)->first();
                $order_item = null;
                if (is_null($order)) {
                    $order = Order::create([
                        'code' => $code,
                        'product_name' => $product_name,
                        'apply_date' => $apply_date != '-' ? $apply_date : now(),
                        'mix_full' => $mix_full,
                        'price' => $price != '-' ? $price : 0,
                        'user_id' => $user_id,
                        'customer_id' => $customer_id,
                        'price_currency' => '$',
                        'status' => OrderStatus::FINISHED,
                    ]);

                    $order_item = $order->items()->create([
                        'status' => OrderStatus::FINISHED,
                        'cbm' => 68,
                    ]);
                }
                $booking_date = null;
                if ($date != '-') {
                    $booking_date = BookingDate::where('date', $date)->first();
                    if (is_null($booking_date)) {
                        $booking_date = BookingDate::create([
                            'date' => $date,
                            'vendor_id' => 1,
                            'container_type_id' => 1,
                            'station_id' => 1,
                            'status' => 1,
                        ]);
                        $status_ids = Status::orderBy('sort', 'asc')->pluck('id')->toArray();
                        $booking_date->statuses()->sync($status_ids);
                    }
                }

                foreach ($container_codes as $container_code) {
                    $container = Container::where('code', $container_code)->first();
                    if (is_null($container)) {
                        $container = Container::create([
                            'code' => $container_code,
                            'packed_volume' => 68,
                            'empty_volume' => 0,
                            'volume' => 68,
                            'container_type_id' => 1,
                            'status' => ContainerStatus::ACCEPTED,
                        ]);
                    }



                    $booking_date->containers()->create([
                        'container_id' => $container?->id,
                        'status' => 1,
                    ]);


                    $order_item->booking()->create([
                        'container_id' => $container->id,
                        'date' => $date,
                    ]);
                }

            } catch (\Exception $ex) {
                continue;
            }

        }
        return [
            'status' => 'success',
            'message' => 'Successfully imported',
        ];

    }
}
