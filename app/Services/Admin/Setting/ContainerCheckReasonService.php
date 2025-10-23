<?php

namespace App\Services\Admin\Setting;

use App\Services\Admin\Setting\SettingService;
use App\Models\ContainerCheckReason;

class ContainerCheckReasonService extends SettingService
{
    protected $model = ContainerCheckReason::class;
}
