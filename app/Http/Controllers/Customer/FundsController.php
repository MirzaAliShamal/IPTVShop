<?php

namespace App\Http\Controllers\Customer;

use App\Models\GiftCard;
use App\Models\FundsCard;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\UserGiftCard;
use Illuminate\Http\Request;
use App\Models\PayPalAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    public function index()
    {
        $giftCards = GiftCard::orderBy('amount', 'ASC')->get();
        $paypalCards = FundsCard::where('type', 'paypal')->orderBy('amount', 'ASC')->get();
        $visaCards = FundsCard::where('type', 'visa')->orderBy('amount', 'ASC')->get();
        return view('app.funds.index', get_defined_vars());
    }

    public function paypal($id)
    {
        $fund = FundsCard::find($id);
        $paypalEmail = PayPalAccount::inRandomOrder()->first();
        return view('app.funds.paypal', get_defined_vars());
    }

    public function visa($id)
    {
        $fund = FundsCard::find($id);
        $bankAccount = BankAccount::inRandomOrder()->first();
        return view('app.funds.visa', get_defined_vars());
    }

    public function purchase(Request $request, $id)
    {
        $fund = FundsCard::find($id);
        if ($request->method == "paypal") {
            $paypalAcc = PayPalAccount::find($request->pay_pal_account_id);

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'type' => 'paypal',
                'amount' => $fund->amount,
                'sender_paypal_email' => $request->paypal_email,
                'company_paypal_email' => $paypalAcc->email,
            ]);

            return redirect()->route('funds.thankyou');
        } else if ($request->method == "visa") {
            $bankAcc = BankAccount::find($request->bank_account_id);

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'type' => 'visa',
                'amount' => $fund->amount,
                'sender_bank_iban' => $request->visa_iban,
                'company_bank_name' => $bankAcc->name,
                'company_bank_iban' => $bankAcc->iban,
                'company_bank_bic' => $bankAcc->bic,
            ]);

            return redirect()->route('funds.thankyou');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    public function thankyou()
    {
        return view('app.funds.thankyou', get_defined_vars());
    }

    public function insufficient()
    {
        return view('app.funds.insufficient', get_defined_vars());
    }

    public function redeemGiftCard()
    {
        return view('app.funds.redeem_giftcard', get_defined_vars());
    }

    public function storeRedeemGiftCard(Request $request)
    {
        $user  = Auth::user();
        $redeem = UserGiftCard::create([
            'user_id' => $user->id,
            'user_link' => $request->user_link,
            'code' => $request->code,
        ]);
        return redirect()->route('funds.thankyou');
    }
}
