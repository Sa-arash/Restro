<?php

namespace App\Livewire;

use App\Models\Copon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductInvoice;
use App\Models\Table;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartPage extends Component
{

    public $products = [], $cartProduct, $tables,$step=1;
    public $total;
    #[Validate('required', message: 'لطفا کد تخفیف خود را وارد کنید')]
    public $couponCode;

    public $errorCuponCode,$successCode;

    public $name,$phoneNumber,$tb,$method=1;

    public function mount()
    {
        $this->cartProduct = json_decode(request()->cookie('products'), true) ?? [];
        $this->products = Product::query()->whereIn('id', array_keys($this->cartProduct))->get();
        $this->totalUpdate();
        $this->tables = Table::query()->get();
    }

    #[On('totalUpdate')]
    public function totalUpdate()
    {
        $this->total = 0;
        $this->cartProduct = json_decode(request()->cookie('products'), true) ?? [];
        $this->products = Product::query()->whereIn('id', array_keys($this->cartProduct))->get();
        foreach ($this->products as $product) {
            $count = $this->cartProduct[$product->id];
            if ($product->discount_end >= now()->startOfDay()->toDateString()) {
                $this->total = ($product->price - (($product->price * $product->discount) / 100)) * $count;
            } else {
                $this->total += $product->price * $count;
            }
        }
    }

    public function setCoupon()
    {
        $this->validate();
        $user=auth()->id();
        if ($user){
            $coupon = Copon::query()->where('user_id',$user )->where('token', $this->couponCode)->first();
            if ($coupon) {
                if ($coupon->start_date >= now()->format('Y-m-d')) {
                    if ($coupon->end_date > now()->format('Y-m-d')) {
                        if ($coupon->min_price < $this->total) {
                            $this->totalUpdate();
                            $discountPrice = ($this->total * $coupon->discount) / 100;
                            if ($discountPrice > $coupon->max_price) {
                                $this->total -= $coupon->max_price;
                                $this->successCode = "کد تخفیف شما اعمال و مبلغ ".number_format($coupon->max_price)." تومان از سبد خرید شما کسر شد ";
                            } else {
                                $this->total -= $discountPrice;
                                $this->successCode = "کد تخفیف شما اعمال و مبلغ ".number_format($discountPrice)." تومان از سبد خرید شما کسر شد ";
                            }
                            $this->errorCuponCode = null;
                        } else {
                            $this->errorCuponCode = "حداقل سفارش شما برای استفاده از این کد تخفیف " . number_format($coupon->min_price) . " تومان است";
                        }
                    } else {
                        $this->errorCuponCode = "تاریخ استفاده از کد تخفیف به پایان رسیده ";
                    }
                } else {
                    $this->errorCuponCode = "تاریخ شروع استفاده از کد تخفیف هنوز شروع نشده";
                }
            } else {
                $this->errorCuponCode = "همچین خود تخفیفی برای شما وجود ندارد";
            }
        } else {
            $this->errorCuponCode = "برای استفاده از کد تخفیف ابتدا وارد حساب کاربری خود شوید";
        }
    }

    public function deleteAll()
    {
        Cookie::queue(Cookie::forget('products'));
        $this->total = 0;

        $this->products = [];
    }
    public function stepTwe(){
            $this->step=2;
    }
    public function stepThree(){
        if (auth()->user()){
            $this->validate([
                'tb'=>'required|exists:tables,id'
            ],[
                'tb.required'=>'میز را انتخاب کنید'
            ]);
        }else{
            $this->validate([
                'name'=>'required|min:3',
                'phoneNumber'=>'required|min:11|max:11',
                'tb'=>'required|exists:tables,id'
            ],[
                'phoneNumber.required'=>'شماره تلفن الزامی است'
            ],[
                'phoneNumber'=>'شماره تلفن',
                'tb'=>'میز'
            ]);
        }

        $this->step=3;
    }

    public function save(){
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
            $coupon = Copon::query()->where('user_id', auth()->id())->where('token', $this->couponCode)->first();
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


            if (empty($products[0])){
                $this->step=1;
                return ;
            }
            $user = auth()->user();
            $invoice = Invoice::query()->create([
                'name' => $user->name,
                'phone' => $user->phone_number,
                'user_id' => $user->id,
                'table_id' => $this->tb,
                'order_date' => now()->toDate(),
                'payment_date' => null,
                'status' => 'order',
                'total_discount' => $couponPrice,
                'total_amount' => $total,
            ]);
        } else {

            $invoice = Invoice::query()->create([
                'name' => $this->name,
                'phone' => $this->phoneNumber,
                'table_id' => $this->tb,
                'order_date' => now()->toDate(),
                'payment_date' => null,
                'status' => 'order',
                'total_discount' => $couponPrice,
                'total_amount' => $total,
            ]);
        }
        $table=Table::query()->firstWhere('id',$this->tb);
//        $table->update(['status'=>'use']);
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

        if ($this->method===1){
            return redirect(route('darga.url'));
        }
        dd(number_format($total) . " مبلغ قابل پرداخت   ");

    }
    public function paymentMethod($method){
        dd($method);
    }

    public function render()
    {


        return view('livewire.cart-page');
    }
}
