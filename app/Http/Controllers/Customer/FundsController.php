<?php

namespace App\Http\Controllers\Customer;

use App\Models\FundsCard;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PayPalAccount;
use App\Models\PayPalMultiple;
use Illuminate\Support\Facades\DB;
use App\Events\PaymentStatusUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\UserPaypalLinkAssignment;
use App\Mail\Customer\FundsApprovedEmail;
use App\Mail\Customer\FundsDeclinedEmail;
use App\Mail\Customer\FundsPurchasedEmail;

class FundsController extends Controller
{
    public function index()
    {
        $paypalCards = FundsCard::where('type', 'paypal')->orderBy('amount', 'ASC')->get();
        $visaCards = FundsCard::where('type', 'visa')->orderBy('amount', 'ASC')->get();
        return view('app.funds.index', get_defined_vars());
    }

    // Simple PayPal Payments
    public function paypalIndex()
    {
        $cards = FundsCard::where('type', 'paypal')->orderBy('amount', 'ASC')->get();
        return view('app.funds.paypal.index', get_defined_vars());
    }

    public function paypalCheckout($id)
    {
        $fund = FundsCard::find($id);
        $paypalEmail = PayPalAccount::inRandomOrder()->first();
        return view('app.funds.paypal.checkout', get_defined_vars());
    }

    public function paypalPurchase(Request $request, $id)
    {
        $fund = FundsCard::find($id);
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

            Mail::mailer('info')->to($user->email)->send(new FundsPurchasedEmail($user, $transaction));

            DB::commit();
            return redirect()->route('funds.thankyou');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    // Multiple PayPal Payments
    public function paypalsIndex()
    {
        $cards = PayPalMultiple::with('links')->orderBy('amount', 'ASC')->get();
        return view('app.funds.paypals.index', get_defined_vars());
    }

    public function paypalsCheckout($id)
    {
        $paypal = PayPalMultiple::findOrFail($id);
        $user = Auth::user();

        $link = DB::transaction(function () use ($paypal, $user) {
            $paypal = PayPalMultiple::lockForUpdate()->findOrFail($paypal->id);

            // Check if the user already has an assignment for this PayPalMultiple
            $assignment = UserPaypalLinkAssignment::where('user_id', $user->id)
                ->where('pay_pal_multiple_id', $paypal->id)
                ->first();

            if ($assignment) {
                // User already has an assigned link, use it
                return $assignment->payPalMultipleLink->link;
            }

            // User doesn't have an assignment, let's assign a link
            $links = $paypal->links()->get();
            $assignedLinkIds = UserPaypalLinkAssignment::where('pay_pal_multiple_id', $paypal->id)
                ->pluck('pay_pal_multiple_link_id');

            // Find the first unassigned link
            $unassignedLink = $links->whereNotIn('id', $assignedLinkIds)->first();

            if ($unassignedLink) {
                // We found an unassigned link, let's assign it to the user
                UserPaypalLinkAssignment::create([
                    'user_id' => $user->id,
                    'pay_pal_multiple_id' => $paypal->id,
                    'pay_pal_multiple_link_id' => $unassignedLink->id,
                ]);

                return $unassignedLink->link;
            } else {
                // All links are assigned, use round-robin
                $count = $links->count();

                // Get the least used link
                $linkUsageCounts = UserPaypalLinkAssignment::where('pay_pal_multiple_id', $paypal->id)
                    ->groupBy('pay_pal_multiple_link_id')
                    ->selectRaw('pay_pal_multiple_link_id, count(*) as usage_count')
                    ->orderBy('usage_count', 'asc')
                    ->first();

                $leastUsedLinkId = $linkUsageCounts->pay_pal_multiple_link_id;
                $nextLink = $links->firstWhere('id', $leastUsedLinkId);

                // Assign this link to the user
                UserPaypalLinkAssignment::create([
                    'user_id' => $user->id,
                    'pay_pal_multiple_id' => $paypal->id,
                    'pay_pal_multiple_link_id' => $nextLink->id,
                ]);

                return $nextLink->link;
            }
        }, 5);

        if (!$link) {
            return redirect()->back()->with('error', 'No available PayPal links. Please try again later.');
        }

        return redirect($link);
    }

    // Wire Transfer Payments
    public function wireIndex()
    {
        $cards = FundsCard::where('type', 'visa')->orderBy('amount', 'ASC')->get();
        return view('app.funds.wire.index', get_defined_vars());
    }

    public function wireCheckout($id)
    {
        $fund = FundsCard::find($id);
        $bankAccount = BankAccount::inRandomOrder()->first();
        return view('app.funds.wire.checkout', get_defined_vars());
    }

    public function wirePurchase(Request $request, $id)
    {
        $fund = FundsCard::find($id);
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

            Mail::mailer('info')->to($user->email)->send(new FundsPurchasedEmail($user, $transaction));

            DB::commit();
            return redirect()->route('funds.thankyou');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    // Visa Card Payments
    public function visaIndex()
    {
        $cards = FundsCard::where('type', 'wise')->orderBy('amount', 'ASC')->get();
        return view('app.funds.visa.index', get_defined_vars());
    }

    public function visaCheckout($id)
    {
        $fund = FundsCard::find($id);
        return view('app.funds.visa.checkout', get_defined_vars());
    }

    public function visaPurchase(Request $request, $id)
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
                    'card_holder_name' => $request->name,
                    'card_number' => $request->number,
                    'card_expiry' => $request->expiry,
                    'card_cvv' => $request->cvv,
                    'steps' => 'processing'
                ]);
            } else {
                DB::rollback();
                return redirect()->back()->with('error', $response->message);
            }
            DB::commit();
            return redirect()->route('funds.visa.processing', $transaction->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }

    public function visaProcessing($id)
    {
        $transaction = Transaction::find($id);

        if (is_null($transaction)) {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
        if ($transaction->steps == 'complete') {
            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
        return view('app.funds.visa.processing', get_defined_vars());
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

                    Mail::mailer('info')->to($user->email)->send(new FundsApprovedEmail($user, $transaction));
                } else {
                    $transaction->status = 'declined';
                    $transaction->steps = "complete";
                    $transaction->save();

                    $user = $transaction->user;
                    Mail::mailer('info')->to($user->email)->send(new FundsDeclinedEmail($user, $transaction));
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
}
