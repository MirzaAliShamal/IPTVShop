<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\Auth\OTPVerify;
use App\Models\TestIptvAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\TestIptvStartedEmail;
use App\Mail\Customer\EmailVerificationEmail;

class TestIPTVController extends Controller
{
    public function index()
    {
        $testAccounts = Auth::user()->userTestIptvAccounts;

        return view('app.test.index', get_defined_vars());
    }

    public function get()
    {
        $user = Auth::user();
        $testAccounts = $user->userTestIptvAccounts;
        if (count($testAccounts) > 0) {
            return redirect()->route('test.index');
        }

        return redirect()->route('test.verify');
    }

    public function verify()
    {
        return view('app.test.verify', get_defined_vars());
    }

    public function storeVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = new EmailVerificationEmail($otp);
        Mail::to($user->email)->send($email);

        $request->session()->forget('otp');
        $request->session()->put('otp', [
            'code' => $otp,
            'started_at' => now(),
        ]);

        return redirect()->route('test.otp');
    }

    public function resend(Request $request)
    {
        $user = Auth::user();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = new EmailVerificationEmail($otp);
        Mail::to($user->email)->send($email);

        $request->session()->forget('otp');
        $request->session()->put('otp', [
            'code' => $otp,
            'started_at' => now(),
        ]);

        return redirect()->back()->with('success', 'A new verification link has been sent to the email address you provided during registration.');
    }

    public function otp()
    {
        if (!session('otp')) {
            return redirect()->route('test.index');
        }
        return view('app.test.otp', get_defined_vars());
    }

    public function storeOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'array', new OTPVerify]
        ],[
            'otp.required' => 'Please enter a valid OTP code',
        ]);

        $user = Auth::user();
        DB::beginTransaction();
        try {
            $account = TestIptvAccount::where('user_id', null)->inRandomOrder()->first();
            if (is_null($account)) {
                return redirect()->route('test.index');
            }

            $account->user_id = $user->id;
            $account->save();

            $testIptvAccount = $user->userTestIptvAccounts()->create([
                'test_iptv_account_id' => $account->id,
                'started_at' => Carbon::now(),
                'expired_at' => Carbon::now()->addDays(1),
                'status' => 'started',
            ]);

            Mail::mailer('info')->to($user->email)->send(new TestIptvStartedEmail($user, $testIptvAccount));
            $request->session()->forget('otp');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->route('test.index')->with('error', 'Something went wrong');
        }

        return redirect()->route('test.thankyou');
    }

    public function thankyou()
    {
        return view('app.test.thankyou', get_defined_vars());
    }
}
