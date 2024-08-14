<?php

namespace App\Http\Controllers\Customer;

use App\Models\FundsCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FundsController extends Controller
{
    public function index()
    {
        $giftCards = FundsCard::where('type', 'giftcard')->orderBy('amount', 'ASC')->get();
        $paypalCards = FundsCard::where('type', 'paypal')->orderBy('amount', 'ASC')->get();
        $visaCards = FundsCard::where('type', 'visa')->orderBy('amount', 'ASC')->get();
        return view('app.funds.index', get_defined_vars());
    }
}
