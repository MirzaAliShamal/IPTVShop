<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\IptvService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class IPTVServiceController extends Controller
{
    public function index()
    {
        return view('admin.iptv-service.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = IptvService::orderBy('id', 'DESC');

        return Datatables::of($list)
            ->editColumn('logo', function($row) {
                $html = '';
                $html .= '
                    <div class="d-flex align-items-center">
						<div class="symbol symbol-50px symbol-circle">
							<img src="'.Storage::url($row->logo).'" class="" alt="">
						</div>
					</div>
                ';
                return $html;
            })
            ->editColumn('connection_type', function($row) {
                if ($row->connection_type == 'single') {
                    return 'Single Connection';
                } else {
                    return 'Multi Connection';
                }
            })
            ->editColumn('duration', function($row) {
                return $row->duration.' Month';
            })
            ->editColumn('price', function($row) {
                return '£'.$row->price;
            })
            ->editColumn('status', function($row) {
                $html = '';
                if ($row->status == 0) {
                    $html .= '<span class="badge badge-light-danger fs-8 fw-bolder">Disabled</span>';
                } else if ($row->status == 1) {
                    $html .= '<span class="badge badge-light-success fs-8 fw-bolder">Active</span>';
                }
                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.iptv.service.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.iptv.service.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['logo', 'connection_type', 'duration', 'price', 'status', 'action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.iptv-service.add', get_defined_vars());
    }

    public function edit(IptvService $iptvService)
    {
        return view('admin.iptv-service.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'connection_type' => 'required|in:single,multi',
            'duration' => 'required|in:1,3,6,12',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
            'logo' => 'required|file|max:10000'
        ]);

        DB::beginTransaction();
        try {
            $iptvService = IptvService::create($request->except('logo'));
            if (isset($request->logo)) {
                $fileName = Str::random(36).'.'.$request->logo->getClientOriginalExtension();
                $filePath = "iptv-services/{$iptvService->id}/{$fileName}";

                Storage::put($filePath , file_get_contents($request->logo));
                $iptvService->logo = $filePath;
                $iptvService->save();
            }

            DB::commit();
            return redirect()->route('admin.iptv.service.index')->with('Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, IptvService $iptvService)
    {
        $request->validate([
            'connection_type' => 'required|in:single,multi',
            'duration' => 'required|in:1,3,6,12',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
            'logo' => 'nullable|file|max:10000'
        ]);
        DB::beginTransaction();
        try {
            $data = $request->except('logo');
            if (isset($request->logo)) {
                if ($iptvService->logo) {
                    Storage::delete($iptvService->logo);
                }
                $fileName = Str::random(36).'.'.$request->logo->getClientOriginalExtension();
                $filePath = "iptv-services/{$iptvService->id}/{$fileName}";

                Storage::put($filePath , file_get_contents($request->logo));
                $data['logo'] = $filePath;
            }
            $iptvService->update($data);

            DB::commit();
            return redirect()->route('admin.iptv.service.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(IptvService $iptvService)
    {
        $iptvService->delete();
        return redirect()->route('admin.iptv.service.index')->with('Record deleted successfully!');
    }
}
