<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function paypal()
    {
        return view('admin.transaction.paypal', get_defined_vars());
    }

    public function visa()
    {
        return view('admin.transaction.visa', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = Transaction::where('type', $request->type)
            ->orderBy('id', 'DESC');

        if ($request->type == "paypal") {
            return Datatables::of($list)
                ->editColumn('amount', function($row) {
                    return $row->amount.'£';
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
                    return $row->amount.'£';
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
                ->rawColumns(['company_bank', 'status', 'action'])
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
