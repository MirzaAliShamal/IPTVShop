<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ProductOrder;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $activeIptvSubscriptions = Subscription::where('type', 'iptv')->where('status', 'started')->count();
        $otherIptvSubscriptions = Subscription::where('type', 'other')->where('status', 'started')->count();
        $totalProductOrders = ProductOrder::count();
        $usersCount = User::where('role','user')->count();
        return view('admin.dashboard.index', get_defined_vars());
    }

    public function profile()
    {
        return view('admin.dashboard.profile', get_defined_vars());
    }

    public function basic(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $admin = Auth::user();
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->save();

        return redirect()->back()->with('success', 'Account details updated successfully');
    }

    public function password(Request $req)
    {
        $req->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::user();;
        $admin->password = bcrypt($req->password);
        $admin->save();

        return redirect()->back()->with('success', 'Account password updated successfully');
    }
}
