<?php

namespace App\Services\Admin\Account;

use App\Services\MainService;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseService extends MainService
{
    protected $model = Expense::class;

    public function filter(Request $request)
    {
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $type = $request->get('type');

        $query = $this->model::query()
            ->orderBy('last_payment_date', 'desc');

        if (!is_null($type)) {
            $query->where('expense_type', $type);
        }

        if (!is_null($search)) {
            $query->where(function ($q) use ($search) {
                return $q
                    ->where('log_id', 'like', "%$search%")
                    ->orWhere('factory', 'like', "%$search%")
                    ->orWhere('note', 'like', "%$search%");
            });
        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('last_payment_date', [$start, $end]);
        }

        return $query->paginate($limit);
    }

    public function add_payment(Expense $expense, array $data)
    {
        $expense->payments()->create($data);
        $remainder = $expense->remainder - ($data['amount'] ?? 0);
        $expense->remainder = $remainder;
        if ($remainder <= 0) {
            if ($expense->expense_type == \App\Enums\ExpenseType::ONETIME) {
                $expense->status = 1;
            } else {
                $expense->last_payment_date = $expense->last_payment_date->addMonth();
            }
        }
        $expense->save();
    }
}
