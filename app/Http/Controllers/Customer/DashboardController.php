<?php

namespace App\Http\Controllers\Customer;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $subcriptions = Subscription::where('user_id', Auth::user()->id)
            ->where('status', 'started')
            ->orderBy('id', 'DESC')->get();

        return view('app.dashboard', get_defined_vars());
    }

    public function shippingAddress()
    {
        return view('app.shipping_address', get_defined_vars());
    }

    public function storeShippingAddress(Request $request)
    {
        Auth::user()->update($request->except('_token'));
        return redirect()->back()->with('success', 'Shipping address saved');
    }

    public function help()
    {
        return view('app.help', get_defined_vars());
    }
}
