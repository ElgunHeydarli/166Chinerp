<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserService extends MainService
{
    protected $model = User::class;

    public function filter(Request $request)
    {
        $search = $request->get('search');
        $limit = $request->get('limit', 10);
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $status = $request->get('status');

        $query = User::query()
            ->orderBy('created_at', 'desc');

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('start_date', [$start, $end]);
        }

        if (!is_null($search)) {
            $query->where(function ($q) use ($search) {
                return $q
                    ->where('firstname', 'like', "%$search%")
                    ->orWhere('lastname', 'like', "%$search%")
                    ->orWhere('position', 'like', "%$search%")
                    ->orWhereHas('country', function ($q) use ($search) {
                        return $q->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('branch', function ($q) use ($search) {
                        return $q->where('name', 'like', "%$search%");
                    });
            });
        }

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        $users = $query->paginate($limit);
        return $users;
    }

    public function getUsersForRole(string $role)
    {
        $roles = explode('|', $role);
        return $this->model::whereHas('roles', function ($q) use ($roles) {
            return $q->whereIn('name', $roles);
        })->get();
    }

    public function getActiveUsers()
    {
        return $this->model::query()
            ->where('status', 1)
            ->get();
    }

    public function getUserByEmail(string $email): User|null
    {
        return $this->model::where('email', $email)
            ->where('status', 1)
            ->first();
    }

    public function getCommentSendedUsers(array $roles)
    {
        return $this->model::query()
            ->where('id', '!=', auth()->id())
            ->whereHas('roles', function ($q) use ($roles) {
                return $q->whereIn('name', $roles);
            })
            ->get();
    }

    public function getLatestUserId(): int
    {
        return ($this->model::orderBy('created_at', 'desc')->first()?->id ?? 0) + 1;
    }

    public function addMultipleUsers(array $data)
    {
        foreach ($data['firstname'] as $key => $firstname) {
            $name = $firstname . ' ' . $data['lastname'][$key];
            $user = $this->create([
                'firstname' => $firstname,
                'lastname' => $data['lastname'][$key],
                'name' => $name,
                'fin' => $data['fin'][$key],
                'position' => $data['position'][$key],
                'mmc' => $data['mmc'][$key],
                'email' => $data['email'][$key],
                'password' => bcrypt($data['password'][$key]),
                'phone' => $data['phone'][$key],
                'gender' => $data['gender'][$key],
                'education_id' => $data['education_id'][$key],
                'branch_id' => $data['branch_id'][$key],
                'country_id' => $data['country_id'][$key],
                'gross_salary' => $data['gross_salary'][$key],
                'cash' => $data['cash'][$key],
                'bank' => $data['bank'][$key],
                'status' => $data['status'][$key],
                'government_payment' => $data['government_payment'][$key],
                'net_salary' => $data['net_salary'][$key],
                'currency' => $data['currency'][$key],
                'start_date' => $data['start_date'][$key],
                'end_date' => $data['end_date'][$key],
                'image' => isset($data['image'][$key]) ? $data['image'][$key] : '',
            ]);
            $this->addRoles($user, $data['role'][$key]);
        }
    }

    public function addRoles(User $user, $roles)
    {
        $user->syncRoles([$roles]);
    }

    public function get_notification_users(Order $order): array
    {
        $users_data = [];
        $users_data[$order->user_id] = $order->user;
        $users = $this->getUsersForRole('admin');
        foreach ($users as $user) {
            if (!isset($users_data[$user->id]))
                $users_data[$user->id] = $user;
        }

        return $users_data;
    }
}
