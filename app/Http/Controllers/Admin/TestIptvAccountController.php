<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Models\TestIptvAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestIptvAccountController extends Controller
{
    public function index()
    {
        return view('admin.test_iptv_account.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = TestIptvAccount::with('user')->orderBy('id', 'DESC');

        return Datatables::of($list)
            ->editColumn('details', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex flex-column">
						'.$row->details.'
					</div>
                ';
                return $html;
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
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.test.iptv.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.test.iptv.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['details', 'user', 'action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.test_iptv_account.add', get_defined_vars());
    }

    public function edit(TestIptvAccount $testIptvAccount)
    {
        return view('admin.test_iptv_account.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'details' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $testIptvAccount = TestIptvAccount::create($request->except('_token'));

            DB::commit();
            return redirect()->route('admin.test.iptv.index')->with('Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, TestIptvAccount $testIptvAccount)
    {
        $request->validate([
            'details' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $testIptvAccount->update($data);

            DB::commit();
            return redirect()->route('admin.test.iptv.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(TestIptvAccount $testIptvAccount)
    {
        $testIptvAccount->delete();
        return redirect()->route('admin.test.iptv.index')->with('Record deleted successfully!');
    }
}
