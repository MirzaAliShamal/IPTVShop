<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Models\PayPalAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PayPalAccountController extends Controller
{
    public function index()
    {
        return view('admin.paypal.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = PayPalAccount::orderBy('id', 'DESC');

        return Datatables::of($list)
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.paypal.account.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.paypal.account.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
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
        return view('admin.paypal.add', get_defined_vars());
    }

    public function edit(PayPalAccount $paypal)
    {
        return view('admin.paypal.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        DB::beginTransaction();
        try {
            $paypal = PayPalAccount::create($request->except('_token'));

            DB::commit();
            return redirect()->route('admin.paypal.account.index')->with('Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, PayPalAccount $paypal)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except('logo');
            $paypal->update($data);

            DB::commit();
            return redirect()->route('admin.paypal.account.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(PayPalAccount $paypal)
    {
        $paypal->delete();
        return redirect()->route('admin.paypal.account.index')->with('Record deleted successfully!');
    }
}
