<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Models\PayPalMultiple;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PayPalMultipleController extends Controller
{
    public function index()
    {
        return view('admin.paypal-multiple.index', get_defined_vars());
    }

    public function fetch(Request $request)
    {
        $list = PayPalMultiple::orderBy('amount', 'ASC');

        return Datatables::of($list)
            ->editColumn('amount', function($row) {
                return $row->amount.'€';
            })
            ->addColumn('view', function($row) {
                $html = '';
                $html .= '<a href="'.route('admin.paypal.multiple.view', $row->id).'" class="text-primary text-decoration-underline fs-7 view-links">View Links</a>';

                return $html;
            })
            ->addColumn('action', function($row){
                $html = '';
                $html .= '
                    <a href="'.route('admin.paypal.multiple.edit', $row->id).'" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Record">
                        <i class="bi bi-pencil-square fs-4 cursor-pointer text-primary"></i>
                    </a>
                    <a href="'.route('admin.paypal.multiple.delete', $row->id).'" class="me-2 delete-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                        <i class="bi bi-trash fs-4 cursor-pointer text-danger"></i>
                    </a>
                ';
                return $html;
            })
            ->rawColumns(['view', 'action'])
            ->make(true);
    }

    public function add()
    {
        return view('admin.paypal-multiple.add', get_defined_vars());
    }

    public function edit(PayPalMultiple $paypal)
    {
        return view('admin.paypal-multiple.edit', get_defined_vars());
    }

    public function view(PayPalMultiple $paypal)
    {
        return view('admin.paypal-multiple.view', get_defined_vars());
    }

    public function save(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'links' => 'required|array|min:1',
            'links.*' => 'required|url',
        ]);

        DB::beginTransaction();
        try {
            $paypal = PayPalMultiple::create([
                'amount' => $request->amount,
            ]);
            $links = array_map(function($link) {
                return ['link' => $link];
            }, $request->links);

            $paypal->links()->createMany($links);
            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, PayPalMultiple $paypal)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'links' => 'required|array|min:1',
            'links.*.id' => 'required',
            'links.*.link' => 'required|url',
        ]);

        DB::beginTransaction();
        try {
            $paypal->update([
                'amount' => $request->amount,
            ]);

            // Process links
            $existingLinkIds = $paypal->links->pluck('id')->toArray();
            $updatedLinkIds = [];

            foreach ($request->links as $linkData) {
                if ($linkData['id'] === 'new') {
                    // Create new link
                    $paypal->links()->create(['link' => $linkData['link']]);
                } else {
                    // Update existing link
                    $link = $paypal->links()->find($linkData['id']);
                    if ($link) {
                        $link->update(['link' => $linkData['link']]);
                        $updatedLinkIds[] = $link->id;
                    }
                }
            }

            // Delete links that were not updated or newly created
            $linksToDelete = array_diff($existingLinkIds, $updatedLinkIds);
            $paypal->links()->whereIn('id', $linksToDelete)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(PayPalMultiple $paypal)
    {
        $paypal->delete();
        return redirect()->route('admin.paypal.multiple.index')->with('Record deleted successfully!');
    }
}
