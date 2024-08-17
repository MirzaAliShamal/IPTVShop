<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)->get();

        return view('app.services.index', get_defined_vars());
    }

    public function myService()
    {
        $subcriptions = Subscription::where('type', 'other')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')->get();

        return view('app.services.my_services', get_defined_vars());
    }

    public function purchase($id)
    {
        $service = Service::find($id);
        if (is_null($service)) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        if (Auth::user()->wallet_balance < $service->price) {
            return redirect()->route('funds.insufficient');
        }

        DB::beginTransaction();
        try {
            $subcription = Subscription::create([
                'user_id' => Auth::user()->id,
                'type' => 'other',
                'title' => $service->duration.' Month '.$service->title,
                'duration' => $service->duration,
                'order_placed_at' => Carbon::now()
            ]);

            if ($subcription) {
                $user = Auth::user();
                $user->wallet_balance = $user->wallet_balance - $service->price;
                $user->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('services.thankyou')->with('success', 'Successfully Purchased');
    }

    public function thankyou()
    {
        return view('app.services.thankyou', get_defined_vars());
    }
}
