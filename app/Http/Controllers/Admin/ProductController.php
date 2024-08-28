<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = Product::orderBy('id', 'DESC');

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
            ->editColumn('price', function($row) {
                return $row->price.'€';
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
                    <a href="'.route('admin.product.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.product.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['logo', 'price', 'status', 'action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.product.add', get_defined_vars());
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
            'logo' => 'required|file|max:10000'
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create($request->except('logo'));
            if (isset($request->logo)) {
                $fileName = Str::random(36).'.'.$request->logo->getClientOriginalExtension();
                $filePath = "products/{$product->id}/{$fileName}";

                Storage::put($filePath , file_get_contents($request->logo));
                $product->logo = $filePath;
                $product->save();
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with('Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
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
                if ($product->logo) {
                    Storage::delete($product->logo);
                }
                $fileName = Str::random(36).'.'.$request->logo->getClientOriginalExtension();
                $filePath = "products/{$product->id}/{$fileName}";

                Storage::put($filePath , file_get_contents($request->logo));
                $data['logo'] = $filePath;
            }
            $product->update($data);

            DB::commit();
            return redirect()->route('admin.product.index')->with('Record updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('Record deleted successfully!');
    }
}
