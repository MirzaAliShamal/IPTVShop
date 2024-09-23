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

function paypalTitle($amount, $email) {
    $title = setting('paypal_title');

    $replacements = [
        '{amount}' => $amount,
        '{email}' => $email
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $title);
}

function wireTitle($amount) {
    $title = setting('wire_title');

    $replacements = [
        '{amount}' => $amount
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $title);
}

function visaTitle($amount) {
    $title = setting('visa_title');

    $replacements = [
        '{amount}' => $amount
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $title);
}
