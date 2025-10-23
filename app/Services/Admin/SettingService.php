<?php

namespace App\Services\Admin;

use App\Services\MainService;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingService extends MainService
{
    protected $model = Setting::class;

    public function filter(Request $request)
    {
        $query = $this->model::query()
            ->orderBy('key', 'asc');

        $search = $request->get('search');
        $limit = $request->get('limit', 10);

        if (!is_null($search)) {
            $query->where(function ($q) use ($search) {
                return $q->where('key', 'like', "%$search%")
                    ->orWhere("value_az", "like", "$search")
                    ->orWhere("value_en", "like", "$search")
                    ->orWhere("value_zh", "like", "$search");
            });
        }

        $settings = $query->paginate($limit);

        return $settings;
    }
}
