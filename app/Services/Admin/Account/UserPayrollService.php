<?php

namespace App\Services\Admin\Account;

use App\Enums\PaymentStatus;
use App\Models\UserPayrollAdvance;
use App\Models\UserPayrollPayment;
use App\Services\MainService;
use App\Models\UserPayroll;
use App\Services\UserService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class UserPayrollService extends MainService
{
    protected $model = UserPayroll::class;

    public function __construct(public UserService $userService)
    {

    }

    public function filter(Request $request)
    {
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $query = $this->model::query()->orderBy('created_at', 'desc');

        if (!is_null($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                return $q
                    ->where('firstname', 'like', "%$search%")
                    ->orWhere('lastname', 'like', "%$search%");
            });
        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('last_payment_date', [$start, $end]);
        }

        return $query->paginate($limit);
    }

    public function add_payments(UserPayroll $userPayroll, array $data)
    {
        foreach ($data['cash_value'] as $key => $cash_value) {
            $user = $this->userService->getById($key);
            $bank_value = isset($data['bank_value'][$key]) ? $data['bank_value'][$key] : 0;
            $status = PaymentStatus::NOT_PAID;
            $cash_remainder = ($user->cash ?? 0) - ($cash_value ?? 0);
            $bank_remainder = ($user->bank ?? 0) - ($bank_value ?? 0);
            if ($cash_remainder <= 0 && $bank_remainder <= 0) {
                $status = PaymentStatus::FULL_PAID;
            } elseif ($cash_remainder <= 0 && $bank_remainder > 0) {
                $status = PaymentStatus::CASH_PAID;
            } elseif ($cash_remainder > 0 && $bank_remainder <= 0) {
                $status = PaymentStatus::BANK_PAID;
            }
            $userPayroll->payments()->create([
                'cash_payment' => $cash_value,
                'bank_payment' => $bank_value,
                'government_payment' => isset($data['government_value'][$key]) ? $data['government_value'][$key] : 0,
                'withholding_payment' => isset($data['withholding_value'][$key]) ? $data['withholding_value'][$key] : 0,
                'bonus' => isset($data['bonus_value'][$key]) ? $data['bonus_value'][$key] : 0,
                'currency' => $data['currency'] ?? '',
                'status' => $status,
                'user_id' => $key,
            ]);
        }
    }

    public function add_advance(UserPayrollPayment $userPayrollPayment, array $data)
    {
        $user_payroll_advance = $userPayrollPayment->advance;
        if (is_null($user_payroll_advance)) {
            $user_payroll_advance = $userPayrollPayment->advance()->create([
                'payment_method' => $data['advance_payment_method'],
                'price' => $data['advance_price'],
            ]);
        } else {
            $user_payroll_advance->update([
                'payment_method' => $data['advance_payment_method'],
                'price' => $data['advance_price'],
            ]);
        }

        return $user_payroll_advance;
    }

    public function add_files(UserPayrollAdvance $user_payroll_advance, array $files)
    {
        foreach ($files as $file) {
            $user_payroll_advance->files()->create([
                'file' => $file,
            ]);
        }
    }

    public function get_group_by_date(Request $request)
    {
        $query = $this->model::select([
            'last_payment_date',
            DB::raw("SUM(cash_payment) as total_cash_payment"),
            DB::raw("SUM(bank_payment) as total_bank_payment"),
            DB::raw("SUM(withholding_payment) as total_withholding_payment"),
            DB::raw("SUM(government_payment) as total_government_payment"),
            DB::raw("SUM(bonus) as total_bonus"),
            DB::raw('MIN(status) as status')
        ])
            ->groupBy('last_payment_date')
            ->orderBy('last_payment_date', 'desc');

        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        if (!is_null($search)) {
            $query->where(function ($q) use ($search) {
                $q
                    ->where('cash_payment', 'like', "%$search%")
                    ->orWhere('bank_payment', 'like', "%$search%")
                    ->orWhere('withholding_payment', 'like', "%$search%")
                    ->orWhere('government_payment', 'like', "%$search%")
                    ->orWhere('bonus', 'like', "%$search%");
            });
        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('last_payment_date', [$start, $end]);
        }

        return $query->paginate($limit);

    }

    public function get_by_date($last_payment_date)
    {
        return $this->model::where('last_payment_date', $last_payment_date)->get();
    }
}
