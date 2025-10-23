<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\Salary\CreateRequest;
use App\Http\Requests\Admin\Account\Salary\EditRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\Setting\BranchService;
use App\Services\Admin\Setting\CountryService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\EducationService;
use App\Services\Admin\Setting\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    use FileUploadTrait;
    public function __construct(
        public RoleService $roleService,
        public UserService $userService,
        public BranchService $branchService,
        public CountryService $countryService,
        public CurrencyService $currencyService,
        public EducationService $educationService,
    ) {

    }

    public function index(Request $request)
    {
        $users = $this->userService->filter($request);
        return view('back.pages.account.salary.index', compact('users'));
    }

    public function create()
    {
        $countries = $this->countryService->getActive();
        $branches = $this->branchService->getActive();
        $educations = $this->educationService->getActive();
        $currencies = $this->currencyService->getActive();
        $roles = $this->roleService->getActive();
        $user_id = $this->userService->getLatestUserId();
        return view('back.pages.account.salary.create', compact([
            'countries',
            'branches',
            'educations',
            'currencies',
            'roles',
            'user_id',
        ]));
    }

    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        $this->userService->addMultipleUsers($data);
        if ($request->hasFile('image'))
            $data['image'] = $this->fileUpload($request->file('image'), 'users');
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.salary.index');
    }

    public function show(int $id)
    {
        $user = $this->userService->getById($id);
        return view('back.pages.account.salary.detail', compact('user'));
    }

    public function edit(int $id)
    {
        $countries = $this->countryService->getActive();
        $branches = $this->branchService->getActive();
        $educations = $this->educationService->getActive();
        $currencies = $this->currencyService->getActive();
        $roles = $this->roleService->getActive();
        $user = $this->userService->getById($id);
        return view('back.pages.account.salary.edit', compact([
            'countries',
            'branches',
            'educations',
            'currencies',
            'roles',
            'user',
        ]));
    }

    public function update(int $id, EditRequest $request)
    {
        $user = $this->userService->getById($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $this->fileDelete($user->image);
            $data['image'] = $this->fileUpload($request->file('image'), 'users');
        }
        if (!is_null($data['password']))
            $data['password'] = bcrypt($data['password']);
        else
            $data['password'] = $user->password;

        $this->userService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.salary.index');
    }

    public function filter(Request $request)
    {
        $users = $this->userService->filter($request);
        $view = view('back.pages.account.salary.section.filter', compact('users'))->render();
        return response([
            'status' => 'success',
            'view' => $view,
        ]);
    }

}
