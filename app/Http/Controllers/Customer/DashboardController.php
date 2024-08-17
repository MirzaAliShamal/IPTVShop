<?php

namespace App\Http\Controllers\Customer;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $subcriptions = Subscription::where('user_id', Auth::user()->id)
            ->where('status', 'started')
            ->orderBy('id', 'DESC')->get();

        return view('app.dashboard', get_defined_vars());
    }

    public function editProfile()
    {
        return view('app.edit_profile', get_defined_vars());
    }

    public function storeEditProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
        ]);
        Auth::user()->update($request->except('_token'));
        return redirect()->back()->with('success', 'Profile Updated');
    }

    public function changePassword()
    {
        return view('app.change_password', get_defined_vars());
    }

    public function storeChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $data['password'] = Hash::make($request->password);
        Auth::user()->update($data);
        return redirect()->back()->with('success', 'Profile Updated');
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
