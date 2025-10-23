<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\EditRequest;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\Setting\BranchService;
use App\Services\Admin\Setting\CountryService;
use App\Services\Admin\Setting\CurrencyService;
use App\Services\Admin\Setting\EducationService;
use App\Services\Admin\Setting\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use FileUploadTrait;

    public function __construct(
        public UserService $userService,
        public RoleService $roleService,
        public EducationService $educationService,
        public CountryService $countryService,
        public BranchService $branchService,
        public CurrencyService $currencyService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAll();
        $roles = $this->roleService->getAll();
        return view('back.pages.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educations = $this->educationService->getAll();
        $countries = $this->countryService->getAll();
        $branches = $this->branchService->getAll();
        $currencies = $this->currencyService->getActive();
        $roles = $this->roleService->getAll();
        $user_id = $this->userService->getLatestUserId();
        return view('back.pages.user.create', compact('educations', 'countries', 'branches', 'currencies', 'roles', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        // if ($request->hasFile('image'))
        //     $data['image'] = $this->fileUpload($request->file('image'), 'users');
        // $this->userService->addMultipleUsers($data);
        $data['name'] = $data['firstname'] . ' ' . $data['lastname'];
        $data['status'] = 1;
        $data['password'] = bcrypt($data['password']);
        $user = $this->userService->create($data);
        if (!empty($data['role']))
            $this->userService->addRoles($user, [$data['role']]);
        toastr('Məlumat əlavə olundu');
        return redirect()->route('admin.user.index');
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
        $user = $this->userService->getById($id);
        $educations = $this->educationService->getAll();
        $countries = $this->countryService->getAll();
        $branches = $this->branchService->getAll();
        $currencies = $this->currencyService->getActive();
        $roles = $this->roleService->getAll();
        return view('back.pages.user.edit', compact('user', 'educations', 'countries', 'currencies', 'branches', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, string $id)
    {
        $data = $request->validated();
        $user = $this->userService->getById($id);
        $data['password'] = is_null($data['password']) ? $user->password : bcrypt($data['password']);
        $this->userService->update($id, $data);
        toastr('Məlumat yeniləndi');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->delete($id);
        toastr('Məlumat uğurla silindi');
        return redirect()->route('admin.user.index');
    }

    public function add_user(Request $request)
    {
        $counter = $request->get('counter');
        $educations = $this->educationService->getAll();
        $countries = $this->countryService->getAll();
        $branches = $this->branchService->getAll();
        $currencies = $this->currencyService->getActive();
        $roles = $this->roleService->getAll();
        $user_id = $this->userService->getLatestUserId() + $counter;
        $view = view('back.pages.user.section.add-user', compact('educations', 'countries', 'currencies', 'branches', 'roles', 'user_id'))->render();
        return response([
            'status' => 'success',
            'view' => $view
        ]);
    }

    public function assign_role(int $id, RoleRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->getById($id);
        $this->userService->addRoles($user, $data['role']);
        toastr('İstifadəçiyə role mənimsədildi');
        return redirect()->back();
    }
}
