<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\IptvService;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\TestIptvAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\TestIptvStartedEmail;
use App\Mail\Customer\IptvSubscriptionPurchasedEmail;

class IPTVController extends Controller
{
    public function test()
    {
        $testAccounts = Auth::user()->userTestIptvAccounts;

        return view('app.iptv.test', get_defined_vars());
    }

    public function getTest()
    {
        $user = Auth::user();
        $testAccounts = $user->userTestIptvAccounts;
        if (count($testAccounts) > 0) {
            return redirect()->route('iptv.test');
        }

        DB::beginTransaction();
        try {
            $account = TestIptvAccount::where('user_id', null)->inRandomOrder()->first();
            if (is_null($account)) {
                return redirect()->route('iptv.test');
            }

            $account->user_id = $user->id;
            $account->save();

            $testIptvAccount = $user->userTestIptvAccounts()->create([
                'test_iptv_account_id' => $account->id,
                'started_at' => Carbon::now(),
                'expired_at' => Carbon::now()->addDays(1),
                'status' => 'started',
            ]);

            Mail::to($user->email)->send(new TestIptvStartedEmail($user, $testIptvAccount));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('iptv.test');
    }

    public function mySubscription()
    {
        $subcriptions = Subscription::where('type', 'iptv')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')->get();

        return view('app.iptv.my_subscriptions', get_defined_vars());
    }

    public function services()
    {
        $singleServices = IptvService::where('connection_type', 'single')->where('status', true)->get();
        $multiServices = IptvService::where('connection_type', 'multi')->where('status', true)->get();

        return view('app.iptv.services', get_defined_vars());
    }

    public function purchase($id)
    {
        $iptvService = IptvService::find($id);
        if (is_null($iptvService)) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        if (Auth::user()->wallet_balance < $iptvService->price) {
            return redirect()->route('funds.insufficient');
        }

        DB::beginTransaction();
        try {
            $subscription = Subscription::create([
                'user_id' => Auth::user()->id,
                'type' => 'iptv',
                'title' => $iptvService->duration.' Month Iptv Subscription',
                'duration' => $iptvService->duration,
                'order_placed_at' => Carbon::now()
            ]);

            if ($subscription) {
                $user = Auth::user();
                $user->wallet_balance = $user->wallet_balance - $iptvService->price;
                $user->save();
            }

            Mail::to($user->email)->send(new IptvSubscriptionPurchasedEmail($user, $subscription));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('iptv.thankyou')->with('success', 'Successfully Purchased');
    }

    public function thankyou()
    {
        return view('app.iptv.thankyou', get_defined_vars());
    }
}
