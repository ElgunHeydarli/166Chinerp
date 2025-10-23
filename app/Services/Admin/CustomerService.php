<?php

namespace App\Services\Admin;

use App\Enums\CustomerType;
use App\Models\Customer;
use App\Models\CustomerProperty;
use App\Services\MainService;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CustomerService extends MainService
{
    protected $model = Customer::class;

    public function getCustomer(array $data): Customer|null
    {
        $customer_type = $data['customer_type'];
        $customer = null;
        if ($customer_type == 'physical') {
            $customer = Customer::where('fin', $data['fin'])->first();
            if (is_null($customer)) {
                $customer = $this->create([
                    'name' => $data['customer_name'],
                    'phone' => $data['customer_phone'],
                    'fin' => $data['fin'],
                    'type' => CustomerType::PHYSICAL,
                    'status' => 1,
                ]);
            }
        } elseif ($customer_type == 'legal') {
            $customer = Customer::where('voen', $data['voen'])->first();
            if (is_null($customer)) {
                $customer = $this->create([
                    'name' => $data['customer_name'],
                    'phone' => $data['customer_phone'],
                    'voen' => $data['voen'],
                    'type' => CustomerType::LEGAL,
                    'status' => 1,
                ]);
            }
        }

        return $customer;
    }

    public function getByType(?CustomerType $customer_type)
    {
        return $this->model::where('type', $customer_type)->orderBy('name', 'asc')->paginate(10);
    }

    public function getAllByType(?CustomerType $customer_type)
    {
        return $this->model::where('type', $customer_type)->orderBy('name', 'asc')->get();
    }

    public function search(Request $request)
    {
        $query = $this->model::query()
            ->orderBy('created_at', 'desc');
        $search = $request->get('search');
        $type = $request->get('type');
        if (!empty($type)) {
            $customer_type = CustomerType::from($request->get('type'));
            $query->where('type', $customer_type);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('company_name', 'like', "%$search%")
                    ->orWhere('id', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('fin', 'like', "%$search%")
                    ->orWhere('voen', 'like', "%$search%");
            });
        }

        return $query->paginate(10);
    }

    public function getNewestCustomerId()
    {
        return $this->model::orderBy('id', 'desc')->first()?->id + 1 ?? 1;
    }

    public function getPropertyData(Request $request): array
    {
        return $request->only([
            'voen',
            'legal_address',
            'factical_address',
            'bank_voen',
            'bank_name',
            'code',
            'account',
            'agent_account',
            'swift',
            'director',
            'sector_id',
        ]);
    }

    public function getPersonData(Request $request): array
    {
        return $request->only([
            'person_name',
            'person_phone',
        ]);
    }

    public function add_property(Customer $customer, array $data): CustomerProperty
    {
        if (is_null($customer->property)) {
            return $customer->property()->create($data);
        } else {
            $customer->property->update($data);
            return $customer->property;
        }
    }

    public function add_persons(CustomerProperty $customer_property, array $data)
    {
        $customer_property->responsible_persons()->delete();
        if (count($data) > 0) {
            foreach ($data['person_name'] as $key => $person_name) {
                $customer_property->responsible_persons()->create([
                    'name' => $person_name,
                    'phone' => $data['person_phone'][$key],
                ]);
            }
        }
    }

    public function add_files(Customer $customer, array $files)
    {
        foreach ($files as $file) {
            $customer->files()->create(['file' => $file]);
        }
    }

    public function import(Request $request): array
    {
        try {
            $file = $request->file('file');
            $real_path = $file->getRealPath();
            $spreadSheet = IOFactory::load($real_path);
            $sheet = $spreadSheet->getActiveSheet();
            $row_count = $sheet->getHighestRow();
            for ($i = 2; $i < $row_count; $i++) {
                $fullname = $sheet->getCell('B' . $i)->getValue();
                $email = $sheet->getCell('D' . $i)->getValue();
                $phone = $sheet->getCell('E' . $i)->getValue();
                $voen = $sheet->getCell('J' . $i)->getValue();
                $fin = $sheet->getCell('L' . $i)->getValue();
                $type = $sheet->getCell('N' . $i)->getValue() == 1 ? CustomerType::PHYSICAL : CustomerType::LEGAL;
                $customer = $this->model::where(['type' => $type, 'name' => $fullname])->first();
                if (is_null($customer)) {
                    $this->create([
                        'name' => $fullname,
                        'email' => $email,
                        'phone' => $phone,
                        'voen' => $voen,
                        'fin' => $fin,
                        'type' => $type,
                    ]);
                }
            }

            return [
                'status' => 'success',
                'message' => 'Successfully imported',
            ];
        } catch (\Exception $ex) {
            return [
                'status' => 'error',
                'message' => $ex->getMessage(),
            ];
        }
    }
}
