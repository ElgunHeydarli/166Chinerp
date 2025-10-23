<?php

namespace App\Services\Admin\Setting;

use App\Services\MainService;
use App\Models\ExpenseCategory;

class ExpenseCategoryService extends MainService
{
    protected $model = ExpenseCategory::class;
}
