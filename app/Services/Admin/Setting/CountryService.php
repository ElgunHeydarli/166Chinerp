<?php

namespace App\Services\Admin\Setting;

use App\Models\Country;

class CountryService extends SettingService
{
    protected $model = Country::class;
}
