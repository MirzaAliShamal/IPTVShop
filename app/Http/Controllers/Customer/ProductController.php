<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Customer\ProductPurchasedEmail;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', true)->get();

        return view('app.products.index', get_defined_vars());
    }

    public function view($id)
    {
        $product = Product::find($id);

        return view('app.products.view', get_defined_vars());
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

        if (is_null(Auth::user()->address)) {
            return redirect()->route('shipping.address');
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

            Mail::to($user->email)->send(new ProductPurchasedEmail($user, $order));

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

    public function review(Request $request, $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        $product->reviews()->create([
            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review submitted');
    }
}
