<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\ProductShippedEmail;
use App\Mail\Customer\ProductCanceledEmail;
use App\Mail\Customer\ProductDeliveredEmail;

class ProductOrderController extends Controller
{
    public function index()
    {
        return view('admin.product_order.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = ProductOrder::with('user', 'product')->orderBy('id', 'DESC');
        if (isset($request->status)) {
            $list = $list->where('status', $request->status);;
        }

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
            ->addColumn('product', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column gap-5">
                            <a class="text-dark fw-bolder fs-6">'.$row->product->title.'</a>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->addColumn('address', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-dark fs-7">'.$row->user->address.'</span>
                            <span class="text-dark fs-7">'.$row->user->zipcode.'</span>
                            <span class="text-dark fs-7">'.$row->user->region.'</span>
                            <span class="text-dark fs-7">'.$row->user->city.'</span>
                            <span class="text-dark fs-7">'.$row->user->country.'</span>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->editColumn('status', function($row) {
                $html = '';
                if ($row->status == 'pending') {
                    $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                } else if ($row->status == 'shipped') {
                    $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Shipped</span>';
                } else if ($row->status == 'delivered') {
                    $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Delivered</span>';
                } else if ($row->status == 'canceled') {
                    $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">Canceled</span>';
                }
                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                if ($row->status == 'pending' || $row->status == 'shipped') {
                    $html .= '
                        <a href="'.route('admin.products.order.edit', $row->id).'" class="me-2 update-record" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                            <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                        </a>
                    ';
                }
                $html .= '
                    <a href="'.route('admin.products.order.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['user', 'product', 'address', 'status', 'action'])
            ->make(true);
    }

    public function edit(ProductOrder $productOrder)
    {
        return view('admin.product_order.edit', get_defined_vars());
    }

    public function update(Request $request, ProductOrder $productOrder)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $productOrder->update($data);

            $user = $productOrder->user;
            if ($data['status'] == 'shipped') {
                Mail::to($user->email)->send(new ProductShippedEmail($user, $productOrder));
            } else if ($data['status'] == 'delivered') {
                Mail::to($user->email)->send(new ProductDeliveredEmail($user, $productOrder));
            } else if ($data['status'] == 'canceled') {
                Mail::to($user->email)->send(new ProductCanceledEmail($user, $productOrder));
            }

            DB::commit();
            return redirect()->route('admin.products.order.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(ProductOrder $productOrder)
    {
        $productOrder->delete();
        return redirect()->route('admin.products.order.index')->with('Record deleted successfully!');
    }
}
