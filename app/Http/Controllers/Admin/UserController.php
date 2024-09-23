<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = User::where('role', 'user')->orderBy('id', 'DESC');

        return Datatables::of($list)
            ->editColumn('wallet_balance', function($row) {
                return $row->wallet_balance.'€';
            })
            ->editColumn('address', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-dark fs-7">'.$row->address.'</span>
                            <span class="text-dark fs-7">'.$row->zipcode.'</span>
                            <span class="text-dark fs-7">'.$row->region.'</span>
                            <span class="text-dark fs-7">'.$row->city.'</span>
                            <span class="text-dark fs-7">'.$row->country.'</span>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.user.adjust', $row->id).'" class="me-2 adjust-balance" data-bs-toggle="tooltip" data-bs-placement="top" title="Adjust Balance">
                        <i class="bi bi-cash-stack fs-4 cursor-pointer text-success"></i>
                    </a>
                    <a href="'.route('admin.user.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['address', 'action'])
            ->make(true);
    }

    public function adjust(User $user)
    {
        return view('admin.users.adjust', get_defined_vars());
    }

    public function adjustBalance(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'type' => 'manual',
                'amount' => $request->amount,
                'status' => 'approved',
                'action' => $request->action,
            ]);

            $balance = 0;
            if ($request->action == 'deposit') {
                $balance = $user->wallet_balance + $request->amount;
            } else if ($request->action == 'refund') {
                $balance = $user->wallet_balance - $request->amount;
            }

            if ($transaction) {
                $user->wallet_balance = $balance;
                $user->save();
            }

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User balance adjusted!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('Record deleted successfully!');
    }
}
