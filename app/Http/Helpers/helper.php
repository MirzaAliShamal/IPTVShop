<?php

use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

function setting($key) {
    $setting = Setting::pluck('value', 'name');
    return $setting[$key] ?? '';
}

function activeSubscriptionCount() {
    return Subscription::where('user_id', Auth::user()->id)
            ->where('status', 'started')
            ->count();
}
