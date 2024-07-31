<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IPTVController extends Controller
{
    public function test()
    {
        return view('app.iptv.test', get_defined_vars());
    }
}
