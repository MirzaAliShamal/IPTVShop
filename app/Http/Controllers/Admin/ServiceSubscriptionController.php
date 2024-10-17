<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\ServicesPurchasedEmail;
use App\Mail\Customer\ServicesSuspendedEmail;

class ServiceSubscriptionController extends Controller
{
    public function index()
    {
        return view('admin.service_subscription.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = Subscription::with('user')->where('type', 'other')->orderBy('id', 'DESC');
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
            ->editColumn('title', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-start flex-column gap-5">
                            <a class="text-dark fw-bolder fs-6">'.$row->title.'</a>
                            <div>'.$row->details.'</div>
                        </div>
                    </div>
                ';
                return $html;
            })
            ->editColumn('started_at', function($row) {
                return Carbon::parse($row->started_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('expired_at', function($row) {
                return Carbon::parse($row->expired_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('status', function($row) {
                $html = '';
                if ($row->status == 'pending') {
                    $html .= '<span class="badge badge-light-primary fs-8 fw-bolder">Pending</span>';
                } else if ($row->status == 'started') {
                    $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Started</span>';
                } else if ($row->status == 'expired') {
                    $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">Expired</span>';
                } else if ($row->status == 'suspended') {
                    $html .= '<span class="badge badge-light-warning fs-8 fw-bolder">Suspended</span>';
                }
                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                if ($row->status == 'pending') {
                    $html .= '
                        <a href="'.route('admin.service.subscription.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                            <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                        </a>
                    ';
                }
                if ($row->status == 'started') {
                    $html .= '
                        <a href="'.route('admin.service.subscription.suspend', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend Subscription">
                            <i class="las la-ban fs-3 cursor-pointer text-primary"></i>
                        </a>
                    ';
                }
                $html .= '
                    <a href="'.route('admin.service.subscription.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['user', 'title', 'status', 'action'])
            ->make(true);
    }

    public function edit(Subscription $subscription)
    {
        return view('admin.service_subscription.edit', get_defined_vars());
    }

    public function update(Request $request, Subscription $subscription)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $data['started_at'] = Carbon::now();
            $data['expired_at'] = Carbon::now()->addMonths($subscription->duration);
            $subscription->update($data);

            if ($data['status'] == 'started') {
                $user = $subscription->user;
                Mail::mailer('info')->to($user->email)->send(new ServicesPurchasedEmail($user, $subscription));
            }

            DB::commit();
            return redirect()->route('admin.service.subscription.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('admin.service.subscription.index')->with('Record deleted successfully!');
    }

    public function suspend(Subscription $subscription)
    {
        DB::beginTransaction();
        try {
            $subscription->update([
                'status' => 'suspended',
            ]);
            $user = $subscription->user;
            Mail::mailer('info')->to($user->email)->send(new ServicesSuspendedEmail($user, $subscription));

            DB::commit();
            return redirect()->route('admin.service.subscription.index')->with('Record deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
