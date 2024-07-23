<?php

namespace App\Rules\Auth;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OTPVerify implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $otp = session('otp');
        $value = implode("", $value);

        if ($value == $otp['code']) {
            if ($otp['started_at']->diffInMinutes(now(), true) > 15) {
                $fail('OTP code expired');
            }
        } else {
            $fail('Please enter a valid OTP code');
        }
    }
}
