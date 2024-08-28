<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GiftCardController extends Controller
{
    public function index()
    {
        return view('admin.gift_card.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = GiftCard::orderBy('amount', 'DESC');

        return Datatables::of($list)
            ->editColumn('link', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column">
                            <a href='.$row->link.' class="text-dark fw-bold text-hover-primary fs-6">'.$row->link.'</a>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->editColumn('amount', function($row) {
                return $row->amount.'€';
            })
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.gift.card.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.gift.card.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['link', 'action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.gift_card.add', get_defined_vars());
    }

    public function edit(GiftCard $giftCard)
    {
        return view('admin.gift_card.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'amount' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $giftCard = GiftCard::create($request->except('_token'));
            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, GiftCard $giftCard)
    {
        $request->validate([
            'link' => 'required',
            'amount' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $giftCard->update($request->except('_token'));
            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(GiftCard $giftCard)
    {
        $giftCard->delete();
        return redirect()->back()->with('Record deleted successfully!');
    }
}
