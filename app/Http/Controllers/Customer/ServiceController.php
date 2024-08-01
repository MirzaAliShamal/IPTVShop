<?php

namespace App\Http\Controllers\Customer;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)->get();

        return view('app.services.index', get_defined_vars());
    }
}
