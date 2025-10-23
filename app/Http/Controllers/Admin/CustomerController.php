<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CreateRequest;
use App\Http\Requests\Admin\Customer\EditRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\CustomerService;
use App\Services\Admin\Setting\PaymentTermService;
use App\Services\Admin\Setting\SectorService;
use App\Services\Admin\Setting\SourceService;
use App\Services\UserService;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public CustomerService $customerService,
        public SourceService $sourceService,
        public SectorService $sectorService,
        public UserService $userService,
        public PaymentTermService $paymentTermService
    ) {
    }

    public function index(Request $request)
    {
        $this->authorize('Bütün Müştərilər page - Əməliyyatlar-Bax');
        $customers = $this->customerService->search($request);
        return view('back.pages.customer.index', compact('customers'));
    }

    public function create()
    {
        $this->authorize('Bütün sifarişlər page - Əməliyyatlar-Əlavə et');
        $sources = $this->sourceService->getAll();
        $users = $this->userService->getUsersForRole('Operations manager|Sales coordinator');
        $sectors = $this->sectorService->getAll();
        $customer_id = $this->customerService->getNewestCustomerId();
        $payment_terms = $this->paymentTermService->getActive();
        return view('back.pages.customer.create', compact([
            'sources',
            'users',
            'sectors',
            'payment_terms',
            'customer_id',
        ]));
    }

    public function store(CreateRequest $request)
    {
        $this->authorize('Bütün sifarişlər page - Əməliyyatlar-Əlavə et');
        $data = $request->validated();
        $property_data = $this->customerService->getPropertyData($request);
        $person_data = $this->customerService->getPersonData($request);
        if ($request->hasFile('contract')) {
            $data['contract'] = $this->fileUpload($request->file('contract'), 'customers');
            $data['contract_add_date'] = now();
        }

        if ($request->hasFile('bill_invoice'))
            $data['bill_invoice'] = $this->fileUpload($request->file('bill_invoice'), 'customers');

        if ($request->hasFile('handover'))
            $data['handover'] = $this->fileUpload($request->file('handover'), 'customers');

        if ($request->hasFile('price_agreement_protocol'))
            $data['price_agreement_protocol'] = $this->fileUpload($request->file('price_agreement_protocol'), 'customers');

        $customer = $this->customerService->create($data);
        if ($request->hasFile('files')) {
            $data['files'] = $this->fileUpload($request->file('files'), 'customers');
            $this->customerService->add_files($customer, $data['files']);
        }
        if ($data['type'] == 'legal') {
            $customer_property = $this->customerService->add_property($customer, $property_data);
            $this->customerService->add_persons($customer_property, $person_data);
        }
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.customer.index');
    }

    public function show(int $id)
    {
        $customer = $this->customerService->getById($id);
        return response([
            'status' => 'success',
            'voen_fin' => !is_null($customer->fin) ? $customer->fin : $customer->voen,
            'phone' => $customer->phone,
        ]);
    }

    public function detail(int $id)
    {
        $this->authorize('Bütün Müştərilər page - Əməliyyatlar-Bax');
        $customer = $this->customerService->getById($id);
        return view('back.pages.customer.detail', compact('customer'));
    }

    public function edit(int $id)
    {
        $this->authorize('Bütün Müştərilər page - Əməliyyatlar-Düzəliş et');
        $customer = $this->customerService->getById($id);
        $sources = $this->sourceService->getAll();
        $users = $this->userService->getUsersForRole('Operations manager|Sales coordinator');
        $sectors = $this->sectorService->getAll();
        $payment_terms = $this->paymentTermService->getActive();
        return view('back.pages.customer.edit', compact([
            'customer',
            'sources',
            'users',
            'sectors',
            'payment_terms',
        ]));
    }

    public function update(int $id, EditRequest $request)
    {
        $this->authorize('Bütün Müştərilər page - Əməliyyatlar-Düzəliş et');
        $data = $request->validated();
        $customer = $this->customerService->getById($id);
        $property_data = $this->customerService->getPropertyData($request);
        $person_data = $this->customerService->getPersonData($request);
        if ($request->hasFile('contract')) {
            $data['contract'] = $this->fileUpload($request->file('contract'), 'customers');
            $this->fileDelete($customer->contract);
            $data['contract_add_date'] = now();
        }

        if ($request->hasFile('bill_invoice')) {
            $data['bill_invoice'] = $this->fileUpload($request->file('bill_invoice'), 'customers');
            $this->fileDelete($customer->bill_invoice);
        }


        if ($request->hasFile('handover')) {
            $data['handover'] = $this->fileUpload($request->file('handover'), 'customers');
            $this->fileDelete($customer->handover);
        }

        if ($request->hasFile('price_agreement_protocol')) {
            $data['price_agreement_protocol'] = $this->fileUpload($request->file('price_agreement_protocol'), 'customers');
            $this->fileDelete($customer->price_agreement_protocol);
        }

        if ($request->hasFile('files')) {
            $data['files'] = $this->fileUpload($request->file('files'), 'customers');
            $this->customerService->add_files($customer, $data['files']);
        }
        if ($data['type'] == 'legal') {
            $customer_property = $this->customerService->add_property($customer, $property_data);
            $this->customerService->add_persons($customer_property, $person_data);
        }
        $this->customerService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.customer.index');
    }

    public function destroy(int $id)
    {
        $this->authorize('Bütün Müştərilər page - Əməliyyatlar-Sil');
        $customer = $this->customerService->getById($id);
        $this->fileDelete($customer->contract);
        $this->fileDelete($customer->bill_invoice);
        $this->fileDelete($customer->handover);
        $this->fileDelete($customer->price_agreement_protocol);
        $this->customerService->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Məlumat uğurla silindi'
        ]);
    }

    public function change_status(int $id, Request $request)
    {
        $this->customerService->update($id, ['status' => $request->get('status')]);
        return response([
            'status' => 'success',
            'message' => 'Status uğurla dəyişdirildi',
        ]);
    }

    public function add_person()
    {
        try {
            $view = view('back.pages.customer.section.responsible-person')->render();
            return response([
                'status' => 'success',
                'view' => $view,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx']]);
        $response = $this->customerService->import($request);
        toastr($response['message'], $response['status']);
        return redirect()->back();
    }
}
