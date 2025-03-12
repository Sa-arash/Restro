<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Copon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductInvoice;
use App\Models\Table;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function main()
    {
        $categories = Category::query()->get();
        $products = Product::query()->with('comments')->where('special_offer', 1)->limit(8)->get();
        return view('front/pages/home', compact('categories', 'products'));
    }
    public function menu()
    {
        $categories = Category::query()->get();
        $products = Product::query()->with('comments')->where('special_offer', 1)->limit(8)->get();
        return view('front/pages/menu', compact('categories', 'products'));
    }

    public function productPage($product)
    {
        $product = Product::query()->with('comments')->findOrFail($product);
        return view('front/pages/product-page', compact('product'));
    }


    public function about()
    {

    }
    public function cart()
    {
        return view('front/pages/cart');
    }

    public function payment(Request $request)
    {


        $total = 0;
        $cartProduct = json_decode(request()->cookie('products'), true) ?? [];
        $products = Product::query()->whereIn('id', array_keys($cartProduct))->get();
        foreach ($products as $product) {
            $count = $cartProduct[$product->id];
            if ($product->discount_end >= now()->startOfDay()->toDateString()) {
                $total = ($product->price - (($product->price * $product->discount) / 100)) * $count;
            } else {
                $total += $product->price * $count;
            }
        }
        $couponPrice = 0;

        if (auth()->user()) {
            $coupon = Copon::query()->where('user_id', auth()->id())->where('token', $request->request->get('couponCode'))->first();
            if ($coupon) {
                if ($coupon->start_date >= now()->format('Y-m-d')) {
                    if ($coupon->end_date > now()->format('Y-m-d')) {
                        if ($coupon->min_price < $total) {
                            $discountPrice = ($total * $coupon->discount) / 100;
                            if ($discountPrice > $coupon->max_price) {
                                $total -= $coupon->max_price;
                                $couponPrice = $coupon->max_price;
                            } else {
                                $total -= $discountPrice;
                                $couponPrice = $discountPrice;
                            }
                        }
                    }
                }
            }
        }
        if (auth()->user()) {
            $request->validate([
                'table'=>'required|exists:tables,id',
            ]);

            if (empty($products[0])){
                $request->validate([
                    'products'=>'required',
                ]);
            }
            $user = auth()->user();
            $invoice = Invoice::query()->create([
                'name' => $user->name,
                'phone' => $user->phone_number,
                'user_id' => $user->id,
                'table_id' => $request->request->get('table'),
                'order_date' => now()->toDate(),
                'payment_date' => null,
                'status' => 'order',
                'total_discount' => $couponPrice,
                'total_amount' => $total,
            ]);
        } else {
            $request->validate([
                'name'=>'required|min:1|max:250',
                'phone'=>'required|min:1|max:250',
                'table'=>'required|exists:tables,id'
            ]);
            $invoice = Invoice::query()->create([
                'name' => $request->request->get('name'),
                'phone' => $request->request->get('phone'),
                'table_id' => $request->request->get('table'),
                'order_date' => now()->toDate(),
                'payment_date' => null,
                'status' => 'order',
                'total_discount' => $couponPrice,
                'total_amount' => $total,
            ]);
        }
        $table=Table::query()->firstWhere('id',$request->request->get('table'));
        $table->update(['status'=>'use']);
        foreach ($products as $product) {
            $count = $cartProduct[$product->id];
            if ($product->discount_end >= now()->startOfDay()->toDateString()) {
                $total = ($product->price - (($product->price * $product->discount) / 100)) * $count;
                $priceDiscount=($product->price - (($product->price * $product->discount) / 100));
                ProductInvoice::query()->create([
                    'invoice_id'=>$invoice->id,
                    'product_id' => $product->id,
                    'price' => $priceDiscount,
                    'count' => $count,
                    'discount' => $priceDiscount * $count,
                    'total' => $total
                ]);
            } else {
                $total += $product->price * $count;
                ProductInvoice::query()->create([
                    'invoice_id'=>$invoice->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'count' => $count,
                    'discount' => 0,
                    'total' => $total
                ]);
            }

        }

        if ($request->request->get('type')==="1"){
            return redirect(route('darga.url'));
        }
        dd(number_format($total) . " مبلغ قابل پرداخت   ");
    }
    public function darga(){
        return 'درگاه پرداخت';
    }
}
