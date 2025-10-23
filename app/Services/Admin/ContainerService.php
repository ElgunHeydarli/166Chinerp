<?php

namespace App\Services\Admin;

use App\Enums\ContainerStatus;
use App\Enums\PurchaseType;
use App\Models\Container;
use App\Models\ContainerType;
use App\Services\Admin\Setting\ContainerTypeService;
use App\Services\MainService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ContainerService extends MainService
{
    protected $model = Container::class;

    public function __construct(
        public ContainerTypeService $containerTypeService,
        public BookingDateContainerService $bookingDateContainerService,
        public VendorService $vendorService,
    ) {
    }

    public function getContainersByStatus(ContainerStatus $status)
    {
        return $this->model::where('status', $status)->orderBy('created_at', 'desc')->get();
    }

    public function addMultipleContainers(array $data)
    {
        foreach ($data['purchase_type'] ?? [] as $key => $purchase_type) {
            for ($i = 0; $i < $data['count'][$key]; $i++) {
                $container = $this->create([
                    'purchase_type' => $purchase_type,
                    'purchase_date' => $data['purchase_date'][$key],
                    'last_payment_date' => $data['last_payment_date'][$key],
                    'container_type_id' => $data['container_type_id'][$key],
                    'vendor_id' => $data['vendor_id'][$key],
                    'price' => $data['price'][$key],
                    'volume' => $this->calculate_volume($data['container_type_id'][$key]),
                    'empty_volume' => $this->calculate_volume($data['container_type_id'][$key]),
                    'packed_volume' => 0,
                    'price_currency' => $data['price_currency'][$key],
                    'count' => 1,
                ]);
                if (isset($data['images']))
                    $this->add_images($container, $data['images']);
            }
        }
    }

    public function reject(int $id, array $data): array
    {
        $container = $this->getById($id);
        $booking_date_container = $this->bookingDateContainerService->getByContainerId($container->id);
        if (count($booking_date_container)) {
            return [
                'status' => 'error',
                'message' => 'Bu konteyner rezervasiyada olduğu üçün ləğv etmək mümkün olmadı',
            ];
        }
        $reject = $container->reject;
        if (!is_null($reject)) {
            $reject->update([
                'note' => $data['note'],
                'reject_reason_id' => $data['reject_reason_id'],
            ]);
        } else {
            $container->reject()->create([
                'note' => $data['note'],
                'reject_reason_id' => $data['reject_reason_id'],
            ]);
        }
        $this->update($id, ['status' => ContainerStatus::REJECTED]);
        return [
            'status' => 'success',
            'message' => 'Konteynerin statusu ləğv olundu',
        ];
    }

    public function add_images(Container $container, array $images)
    {
        foreach ($images as $image) {
            $container->images()->create([
                'image' => $image,
            ]);
        }
    }

    public function calculate_volume(int $container_type_id): float
    {
        $container_type = $this->containerTypeService->getById($container_type_id);
        return $container_type->max_size;
    }

    public function filter(Request $request)
    {
        $search = $request->get('search');
        $limit = $request->get('limit', 10);
        $status = $request->get('status', ContainerStatus::ACCEPTED);
        $query = $this->model::query()
            ->where('status', $status)
            ->orderBy('purchase_date', 'desc');

        if (!is_null($search)) {
            $query->where('code', 'like', "%$search%");
        }

        $containers = $query->paginate($limit);
        return $containers;
    }

    public function import(Request $request): array
    {
        try {
            $file = $request->file('file');
            $real_path = $file->getRealPath();
            $spreadSheet = IOFactory::load($real_path);
            $sheet = $spreadSheet->getActiveSheet();
            $row_count = $sheet->getHighestRow();
            DB::beginTransaction();
            for ($i = 2; $i < $row_count; $i++) {
                $code = $sheet->getCell('A' . $i)->getValue();
                $container_type_name = $sheet->getCell('B' . $i)->getValue();
                $container_type = $this->containerTypeService->getByName($container_type_name);
                $purchase_date = Date::excelToDateTimeObject($sheet->getCell('C' . $i)->getValue());
                $last_payment_date = Date::excelToDateTimeObject($sheet->getCell('D' . $i)->getValue());
                $purchase_type = $sheet->getCell('E' . $i)->getValue();
                $price = $sheet->getCell('F' . $i)->getValue();
                $vendor_name = $sheet->getCell('G' . $i)->getValue();
                $vendor = $this->vendorService->getByName($vendor_name);
                $container = $this->model::where('code', $code)->first();
                if (is_null($container)) {
                    $container = $this->create([
                        'code' => $code,
                        'container_type_id' => $container_type?->id,
                        'count' => 1,
                        'price' => $price,
                        'price_currency' => '$',
                        'purchase_type' => $purchase_type == 'İcarə' ? PurchaseType::RENT : PurchaseType::PURCHASE,
                        'purchase_date' => $purchase_date,
                        'last_payment_date' => $last_payment_date,
                        'volume' => $container_type?->max_size,
                        'packed_volume' => 0,
                        'empty_volume' => $container_type?->max_size,
                        'vendor_id' => $vendor?->id
                    ]);
                } else {
                    $container->update([
                        'code' => $code,
                        'container_type_id' => $container_type?->id,
                        'count' => 1,
                        'price' => $price,
                        'price_currency' => '$',
                        'purchase_type' => $purchase_type == 'İcarə' ? PurchaseType::RENT : PurchaseType::PURCHASE,
                        'purchase_date' => $purchase_date,
                        'last_payment_date' => $last_payment_date,
                        'volume' => $container_type?->max_size,
                        'packed_volume' => 0,
                        'empty_volume' => $container_type?->max_size,
                        'vendor_id' => $vendor?->id,
                        'status' => ContainerStatus::ACCEPTED
                    ]);
                }

            }

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Successfully imported',
            ];
        } catch (Exception $ex) {
            return [
                'status' => 'error',
                'message' => $ex->getMessage(),
            ];
        }
    }
}
