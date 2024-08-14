<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BankAccountController extends Controller
{
    public function index()
    {
        return view('admin.bank.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = BankAccount::orderBy('id', 'DESC');

        return Datatables::of($list)
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.bank.account.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.bank.account.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
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
        return view('admin.bank.add', get_defined_vars());
    }

    public function edit(BankAccount $bank)
    {
        return view('admin.bank.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'iban' => 'required',
            'bic' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $bank = BankAccount::create($request->except('_token'));

            DB::commit();
            return redirect()->route('admin.bank.account.index')->with('Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, BankAccount $bank)
    {
        $request->validate([
            'name' => 'required',
            'iban' => 'required',
            'bic' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except('logo');
            $bank->update($data);

            DB::commit();
            return redirect()->route('admin.bank.account.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(BankAccount $bank)
    {
        $bank->delete();
        return redirect()->route('admin.bank.account.index')->with('Record deleted successfully!');
    }
}
