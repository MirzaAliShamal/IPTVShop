<?php

use App\Models\Setting;

function setting($key) {
    $setting = Setting::pluck('value', 'name');
    return $setting[$key] ?? '';
}
