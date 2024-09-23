<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\FundsApprovedEmail;
use App\Mail\Customer\FundsDeclinedEmail;

class TransactionController extends Controller
{
    public function paypal()
    {
        return view('admin.transaction.paypal', get_defined_vars());
    }

    public function wireTransfer()
    {
        return view('admin.transaction.wire', get_defined_vars());
    }

    public function visa()
    {
        return view('admin.transaction.visa', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = Transaction::with('user')->where('type', $request->type)
            ->orderBy('id', 'DESC');
        if (isset($request->status)) {
            $list = $list->where('status', $request->status);;
        }

        if ($request->type == "paypal") {
            return Datatables::of($list)
                ->editColumn('amount', function($row) {
                    return $row->amount.'€';
                })
                ->editColumn('status', function($row) {
                    $html = '';
                    if ($row->status == 'pending') {
                        $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                    } else if ($row->status == 'approved') {
                        $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Approved</span>';
                    } else if ($row->status == 'declined') {
                        $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">declined</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function($row){
                    $html = '';
                    if ($row->status !== 'approved') {
                        $html .= '
                            <a href="'.route('admin.transaction.edit', $row->id).'" class="me-2 update-record" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Status">
                                <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                            </a>
                            <a href="'.route('admin.transaction.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                                <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                            </a>
                        ';
                    }
                    return $html;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else if ($request->type == "visa") {
            return Datatables::of($list)
                ->addColumn('company_bank', function($row){
                    $html = '';
                    $html .= '
                        <div class="d-flex flex-column">
                            <span><strong>Name:</strong>'.$row->company_bank_name.'</span>
                            <span><strong>IBAN:</strong>'.$row->company_bank_iban.'</span>
                            <span><strong>Bic:</strong>'.$row->company_bank_bic.'</span>
                        </div>
                    ';
                    return $html;
                })
                ->editColumn('amount', function($row) {
                    return $row->amount.'€';
                })
                ->editColumn('status', function($row) {
                    $html = '';
                    if ($row->status == 'pending') {
                        $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                    } else if ($row->status == 'approved') {
                        $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Approved</span>';
                    } else if ($row->status == 'declined') {
                        $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">declined</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function($row){
                    $html = '';
                    if ($row->status == 'pending') {
                        $html .= '
                            <a href="'.route('admin.transaction.edit', $row->id).'" class="me-2 update-record" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Status">
                                <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                            </a>
                        ';
                    }
                    $html .= '
                        <a href="'.route('admin.transaction.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                            <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                        </a>
                    ';
                    return $html;
                })
                ->rawColumns(['company_bank', 'status', 'action'])
                ->make(true);
        } else if ($request->type == "wise") {
            return Datatables::of($list)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $query->whereHas('user', function ($q) use ($searchValue) {
                            $q->where('name', 'like', "%{$searchValue}%")
                            ->orWhere('email', 'like', "%{$searchValue}%");
                        })
                        ->orWhere('txn_id', 'like', "%{$searchValue}%")
                        ->orWhere('card_holder_name', 'like', "%{$searchValue}%")
                        ->orWhere('card_number', 'like', "%{$searchValue}%")
                        ->orWhere('amount', 'like', "%{$searchValue}%");
                    }
                })
                ->addColumn('user', function($row) {
                    if ($row->user) {
                        $html = '';
                        $html .= '
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a  class="text-dark fw-bold text-hover-primary fs-6">'.$row->user->name.'</a>
                                    <span class="text-muted text-muted d-block fs-7">'.$row->user->email.'</span>
                                </div>
                            </div>
                        ';
                        return $html;
                    } else {
                        return 'N/A';
                    }
                })
                ->editColumn('card_number', function($row) {
                    $html = '';
                    $html .= '
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-dark d-block fs-6">'.$row->card_holder_name.'</span>
                                <span class="text-muted d-block fs-6">'.$row->card_number.'</span>
                                <span class="text-muted d-block fs-7">'.$row->card_expiry.'</span>
                                <span class="text-muted d-block fs-7">'.$row->card_cvv.'</span>
                            </div>
                        </div>
                    ';
                    return $html;
                })
                ->editColumn('amount', function($row) {
                    return $row->amount.'€';
                })
                ->editColumn('status', function($row) {
                    $html = '';
                    if ($row->status == 'pending') {
                        $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                    } else if ($row->status == 'approved') {
                        $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Approved</span>';
                    } else if ($row->status == 'declined') {
                        $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">Declined</span>';
                    }
                    return $html;
                })
                ->rawColumns(['user', 'card_number', 'status', 'action'])
                ->make(true);
        }
    }

    public function edit(Transaction $transaction)
    {
        return view('admin.transaction.edit', get_defined_vars());
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($request->status === 'approved') {
            $user = $transaction->user;
            $user->wallet_balance = $user->wallet_balance + $transaction->amount;
            $user->save();

            Mail::to($user->email)->send(new FundsApprovedEmail($user, $transaction));
        }
        if ($request->status === 'declined') {
            $user = $transaction->user;
            Mail::to($user->email)->send(new FundsDeclinedEmail($user, $transaction));
        }
        $transaction->update($request->except('_token'));

        return redirect()->back()->with('Record updated successfully!');
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->back()->with('Record deleted successfully!');
    }
}
