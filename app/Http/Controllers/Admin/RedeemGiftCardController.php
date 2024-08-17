<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\UserGiftCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedeemGiftCardController extends Controller
{
    public function index()
    {
        return view('admin.redeem_giftcard.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = UserGiftCard::with('user')->orderBy('id', 'DESC');

        return Datatables::of($list)
            ->addColumn('user', function($row) {
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
            })
            ->editColumn('user_link', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column">
                            <a href='.$row->user_link.' class="text-dark fw-bold text-hover-primary fs-6">'.$row->user_link.'</a>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->editColumn('amount', function($row) {
                if ($row->amount !== null && $row->amount > 0) {
                    return $row->amount.'£';
                } else {
                    return 'N/A';
                }
            })
            ->editColumn('status', function($row) {
                $html = '';
                if ($row->status == 'pending') {
                    $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                } else if ($row->status == 'redeemed') {
                    $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Redeemed</span>';
                } else if ($row->status == 'expired') {
                    $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">Expired</span>';
                }
                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                if ($row->status == 'pending') {
                    $html = '
                        <a href="'.route('admin.redeem.gift.card.edit', $row->id).'" class="me-2 update-record" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                            <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                        </a>
                    ';
                }
                $html .= '
                    <a href="'.route('admin.redeem.gift.card.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['user', 'user_link', 'amount', 'status', 'action'])
            ->make(true);
    }

    public function edit(UserGiftCard $userGiftCard)
    {
        return view('admin.redeem_giftcard.edit', get_defined_vars());
    }

    public function update(Request $request, UserGiftCard $userGiftCard)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            if (isset($data['status']) && $data['status'] == 'redeemed' && isset($data['amount'])) {
                $user = $userGiftCard->user;
                $user->wallet_balance = $user->wallet_balance + $data['amount'];
                $user->save();
            }
            $userGiftCard->update($data);

            DB::commit();
            return redirect()->route('admin.redeem.gift.card.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(UserGiftCard $userGiftCard)
    {
        $userGiftCard->delete();
        return redirect()->route('admin.redeem.gift.card.index')->with('Record deleted successfully!');
    }
}
