<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
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
                return $row->wallet_balance.'£';
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
                    <a href="'.route('admin.user.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['address', 'action'])
            ->make(true);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('Record deleted successfully!');
    }
}
