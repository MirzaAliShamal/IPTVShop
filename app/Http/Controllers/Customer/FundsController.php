<?php

namespace App\Http\Controllers\Customer;

use App\Models\GiftCard;
use App\Models\FundsCard;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\UserGiftCard;
use Illuminate\Http\Request;
use App\Models\PayPalAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\PaymentStatusUpdated;
use App\Mail\Customer\FundsApprovedEmail;
use App\Mail\Customer\FundsDeclinedEmail;
use App\Mail\Customer\FundsPurchasedEmail;
use App\Mail\Customer\RedeemGiftCardSubmitted;

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

    public function wise($id)
    {
        $fund = FundsCard::find($id);
        $bankAccount = BankAccount::inRandomOrder()->first();
        return view('app.funds.wise', get_defined_vars());
    }

    public function purchase(Request $request, $id)
    {
        $fund = FundsCard::find($id);
        if ($request->method == "paypal") {
            DB::beginTransaction();
            try {
                $paypalAcc = PayPalAccount::find($request->pay_pal_account_id);
                $user = Auth::user();

                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'paypal',
                    'amount' => $fund->amount,
                    'sender_paypal_email' => $request->paypal_email,
                    'company_paypal_email' => $paypalAcc->email,
                ]);

                Mail::to($user->email)->send(new FundsPurchasedEmail($user, $transaction));

                DB::commit();
                return redirect()->route('funds.thankyou');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Something went wrong, please try again');
            }
        } else if ($request->method == "visa") {
            DB::beginTransaction();
            try {
                $bankAcc = BankAccount::find($request->bank_account_id);
                $user = Auth::user();

                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'visa',
                    'amount' => $fund->amount,
                    'sender_bank_iban' => $request->visa_iban,
                    'company_bank_name' => $bankAcc->name,
                    'company_bank_iban' => $bankAcc->iban,
                    'company_bank_bic' => $bankAcc->bic,
                ]);

                Mail::to($user->email)->send(new FundsPurchasedEmail($user, $transaction));

                DB::commit();

                return redirect()->route('funds.thankyou');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Something went wrong, please try again');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    public function cardPayment(Request $request, $id)
    {
        $fund = FundsCard::find($id);

        if (is_null($fund)) {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }

        DB::beginTransaction();
        try {
            $data = [
                'currency' => 'eur',
                'amount' => $fund->amount,
                'card_type' => 'debit',
                'card_number' => (int)preg_replace('/\s+/', '', $request->number),
                'expiry_date' => $request->expiry,
                'cvv' => (int)$request->cvv,
                'status_webhook' => route('wise.webhook')
            ];

            $user  = Auth::user();
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://payments.machmich.pro/api/transaction',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: b0ca813f8f244d958c64f49b7c47b36a'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response);
            
            if ($response->success) {
                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'wise',
                    'amount' => $fund->amount,
                    'txn_id' => $response->transaction_id,
                    'steps' => 'processing'
                ]);
            } else {
                DB::rollback();
                return redirect()->back()->with('error', $response->message);
            }
            DB::commit();
            return redirect()->route('funds.processing', $transaction->id);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    public function processing($id)
    {
        $transaction = Transaction::find($id);
        
        if (is_null($transaction)) {
            return redirect()->back()->with('error', 'Something went wrong, please try again'); 
        }
        if ($transaction->steps == 'complete') {
            return redirect()->back()->with('error', 'Something went wrong, please try again'); 
        }
        return view('app.funds.processing', get_defined_vars());
    }

    public function webhook(Request $request)
    {
        $payload = $request->all();
        $transaction = Transaction::where('txn_id', $payload['transaction_id'])->first();
        \Log::info($payload);
        switch ($payload['event']) {
            case 'payment.login':
                broadcast(new PaymentStatusUpdated($transaction->user->id, $payload))->toOthers();
                $transaction->steps = "processing";
                $transaction->save();
                break;

            case 'payment.processing':
                broadcast(new PaymentStatusUpdated($transaction->user->id, $payload))->toOthers();
                $transaction->steps = "approval";
                $transaction->save();
                break;

            case 'card.processing':
                broadcast(new PaymentStatusUpdated($transaction->user->id, $payload))->toOthers();
                $transaction->steps = "approval";
                $transaction->save();
                break;

            case 'bank.approval':
                broadcast(new PaymentStatusUpdated($transaction->user->id, $payload))->toOthers();
                $transaction->steps = "complete";
                $transaction->save();
                break;

            case 'final':
                if ($payload['status'] == 'success') {
                    $transaction->status = 'approved';
                    $transaction->steps = "complete";
                    $transaction->save();

                    $user = $transaction->user;
                    $user->wallet_balance = $user->wallet_balance + $transaction->amount;
                    $user->save();

                    Mail::to($user->email)->send(new FundsApprovedEmail($user, $transaction));
                } else {
                    $transaction->status = 'declined';
                    $transaction->steps = "complete";
                    $transaction->save();

                    $user = $transaction->user;
                    Mail::to($user->email)->send(new FundsDeclinedEmail($user, $transaction));
                }
                broadcast(new PaymentStatusUpdated($transaction->user->id, $payload))->toOthers();
                break;

            default:
                \Log::info('Default Status');
                break;
        }

        return '';
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
        try {
            $user  = Auth::user();
            $redeem = UserGiftCard::create([
                'user_id' => $user->id,
                'user_link' => $request->user_link,
                'code' => $request->code,
            ]);

            Mail::to($user->email)->send(new RedeemGiftCardSubmitted($user, $redeem));

            return redirect()->route('funds.thankyou');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }
}
