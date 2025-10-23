<?php

use App\Models\Setting;

if (!function_exists('trns')) {
    function trns(string $key) : string
    {
        $settings = Setting::pluck('value_' . app()->getLocale(), 'key')->toArray();
        return isset($settings[$key]) ? $settings[$key] : $key;
    }
}
