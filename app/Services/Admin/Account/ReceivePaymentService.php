<?php

namespace App\Services\Admin\Account;

use App\Services\MainService;
use App\Models\ReceivePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceivePaymentService extends MainService
{
    protected $model = ReceivePayment::class;

    public function filter(Request $request)
    {
        $limit = $request->get('limit', 10);
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $query = $this->model::query()->orderBy('date', 'desc');

        if (!is_null($search)) {
            $query->where(function ($q) use ($search) {
                return $q
                    ->whereHas('receive', function ($q) use ($search) {
                        $q->orWhereHas('customer', function ($q) use ($search) {
                            return $q->where('name', 'like', "%$search%");
                        });
                    })
                    ->orWhere('note', 'like', "%$search%");
            });
        }

        if (!is_null($start_date) && !is_null($end_date)) {
            $start = Carbon::createFromFormat('d.m.Y', $start_date)->format('Y-m-d');
            $end = Carbon::createFromFormat('d.m.Y', $end_date)->format('Y-m-d');
            $query->whereBetween('date', [$start, $end]);
        }

        $all_query = clone $query;
        $receives = $query->paginate($limit);
        $all_receives = $all_query->get();
        return [
            'receives' => $receives,
            'all_receives' => $all_receives,
        ];
    }
}
