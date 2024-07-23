<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Rules\Auth\OTPVerify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Mail\Customer\EmailVerificationEmail;

class EmailVerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email', get_defined_vars());
    }

    public function verifyCheck(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'array', new OTPVerify]
        ],[
            'otp.required' => 'Please enter a valid OTP code',
        ]);

        $user = Auth::user();
        $user->email_verified_at = now();
        $user->save();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function verifyResend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            redirect()->intended(RouteServiceProvider::HOME);
        }

        $user = Auth::user();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = new EmailVerificationEmail($otp);
        Mail::to($user->email)->send($email);

        $request->session()->forget('otp');
        $request->session()->put('otp', [
            'code' => $otp,
            'started_at' => now(),
        ]);

        return redirect()->route('verification.notice')->with('success', 'A new verification link has been sent to the email address you provided during registration.');
    }
}
