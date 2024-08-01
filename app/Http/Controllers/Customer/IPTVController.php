<?php

namespace App\Http\Controllers\Customer;

use App\Models\IptvService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IPTVController extends Controller
{
    public function test()
    {
        return view('app.iptv.test', get_defined_vars());
    }

    public function services()
    {
        $singleServices = IptvService::where('connection_type', 'single')->where('status', true)->get();
        $multiServices = IptvService::where('connection_type', 'multi')->where('status', true)->get();

        return view('app.iptv.services', get_defined_vars());
    }
}
