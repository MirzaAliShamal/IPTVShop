<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\FundsCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FundsCardController extends Controller
{
    public function paypal()
    {
        return view('admin.funds-card.paypal', get_defined_vars());
    }

    public function wireTransfer()
    {
        return view('admin.funds-card.wire', get_defined_vars());
    }

    public function visa()
    {
        return view('admin.funds-card.visa', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = FundsCard::where('type', $request->type)->orderBy('amount', 'ASC');

        return Datatables::of($list)
            ->editColumn('amount', function($row) {
                return $row->amount.'€';
            })
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.funds.card.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.funds.card.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.funds-card.add', get_defined_vars());
    }

    public function edit(FundsCard $fundsCard)
    {
        return view('admin.funds-card.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'type' => 'required|in:paypal,visa,wise',
            'amount' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $fundsCard = FundsCard::create($request->except('_token'));
            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, FundsCard $fundsCard)
    {
        $request->validate([
            'type' => 'required|in:paypal,visa,wise',
            'amount' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $fundsCard->update($request->except('_token'));
            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(FundsCard $fundsCard)
    {
        $fundsCard->delete();
        return redirect()->back()->with('Record deleted successfully!');
    }
}
