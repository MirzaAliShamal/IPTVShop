<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', true)->get();

        return view('app.products.index', get_defined_vars());
    }

    public function myProduct()
    {
        $orders = ProductOrder::where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')->get();

        return view('app.products.my_products', get_defined_vars());
    }

    public function purchase($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        if (Auth::user()->wallet_balance < $product->price) {
            return redirect()->route('funds.insufficient');
        }

        DB::beginTransaction();
        try {
            $order = ProductOrder::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
            ]);

            if ($order) {
                $user = Auth::user();
                $user->wallet_balance = $user->wallet_balance - $product->price;
                $user->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('products.thankyou')->with('success', 'Successfully Purchased');
    }

    public function thankyou()
    {
        return view('app.products.thankyou', get_defined_vars());
    }
}
