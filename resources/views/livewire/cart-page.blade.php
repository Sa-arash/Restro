<div>
    <div class="container wrapper-main">
        <div class="cart-container-pay-basket text-center">
            <div class="RouteShopping">
                <div class="box1">
                    <img src="./img/shopping-cart.png" alt=""/>
                    <p class="title-basket-basket" id="responsive-title-basket-basket">
                        سبد خرید -----------
                    </p>
                </div>
                <div class="box2">
                    <img src="{{asset('front/image/tick-square.png')}}" alt=""/>
                    <p
                        class="title-basket-detailes"
                        id="responsive-title-basket-detailes"
                    >
                        تکمیل اطلاعات -----------
                    </p>
                </div>
                <div class="box3">
                    <img src="{{asset('front/image/wallet-2.png')}}" alt=""/>
                    <p class="title-basket-pay" id="responsive-title-basket-pay">
                        پرداخت
                    </p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="payment-methods">
                            <h5 class="Method-title">
                                <img
                                    src="{{asset('front/image/wallet-money.png')}}"
                                    style="margin-left: 10px; width: 25px; height: 25px"
                                    alt=""
                                />روش پرداخت
                            </h5>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="paymentMethod"
                                    id="payAtRestaurant"
                                    value="0"
                                />
                                <label class="form-check-label" for="payAtRestaurant">
                                    <img
                                        src="{{asset('front/image/wallet-2.png')}}"
                                        style="margin-left: 10px; width: 25px; height: 25px"
                                        alt=""
                                    />
                                    پرداخت در رستوران
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="paymentMethod"
                                    id="onlinePayment"
                                    value="1"

                                    checked
                                />
                                <label class="form-check-label" for="onlinePayment">
                                    <img
                                        src="{{asset('front/image/card-pos.png')}}"
                                        style="margin-left: 10px; width: 25px; height: 25px"
                                        alt=""
                                    />
                                    پرداخت اینترنتی
                                </label>
                            </div>
                        </div>
                        <div class="payment-gateways">
                            <h5>انتخاب درگاه پرداخت</h5>
                            <img src="{{asset('front/image/Bank.png')}}" alt="بانک سامان"/>
                            <img src="{{asset('front/image/Bank.png')}}" alt="بانک ملت"/>
                            <p style="color: #7d7c7c">
                                پرداخت از طریق کلیه کارت‌های عضو شتاب امکان‌پذیر است.
                            </p>
                            <p style="color: #7d7c7c">
                                (لطفا قبل از پرداخت فیلترشکن خود را خاموش کنید.)
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-container-pay-basket">
                            <div class="title-cart">
                                <h6>سبد خرید (<span id="cart-count">4</span>)</h6>
                                <img src="{{asset('front/image/trash.png')}}" alt="" id="trash-btn"/>
                            </div>
                            <div class="wrapper-box-cart" style="overflow: auto">
                                @foreach($products as $product)
                                    <div class="cart-item">
                                        <div class="basket-box">
                                            <div class="basket-box-right">
                                                <span>{{$product->title}}</span>

                                                @if($product->discount_end >= now()->startOfDay()->toDateString())
                                                    <del class="text-danger"> {{number_format($product->price)}}
                                                        تومان<span class="badge text-bg-success">{{$product->discount}}% تخفیف</span>
                                                    </del>
                                                    <span class="item-price" style="margin-top: 10px; color: #898989">{{number_format($product->price-(($product->price*$product->discount)/100))}} تومان</span>
                                                @else
                                                    <span class="item-price" style="margin-top: 10px; color: #898989">{{number_format($product->price)}} تومان</span>
                                                @endif
                                            </div>
                                            <div class="">
                                                <livewire:add-to-cart :$product :key="$product->id"/>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <form class="w-100 " method="post" action="{{route('payment.url')}}">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="type" value="1">
                                <div class=" cart-Discount ">
                                    @guest()
                                        <p class="cart-Discount-title">نام و نام خانوادگی</p>
                                        <input required name="name" type="text"
                                               class="form-control w-100  p-1 rounded "/>
                                        <strong class="text-danger">@error('name')  {{$message}} @enderror</strong>
                                        <p class="cart-Discount-title">شماره تلفن</p>
                                        <input required name="phone" type="text"
                                               class="form-control w-100   p-1 rounded "/>
                                        <strong class="text-danger">@error('phone')  {{$message}} @enderror</strong>
                                        <p class="cart-Discount-title">میز</p>
                                        <select name="table" id="" class="form-select ">
                                            @foreach($tables as $table)
                                                <option @if($table->status->name==="Use")  disabled
                                                        @endif value="{{$table->id}}">{{$table->title}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p class="cart-Discount-title">میز</p>
                                        <select name="table" id="" class="form-select ">
                                            @foreach($tables as $table)
                                                <option @if($table->status->name==="Use")  disabled
                                                        @endif value="{{$table->id}}">{{$table->title}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @endguest
                                <strong class="text-danger">@error('table')  {{$message}} @enderror</strong>
                                <strong class="text-danger">@error('products')  {{$message}} @enderror</strong>
                                <div class="cart-Discount">
                                    <p class="cart-Discount-title">کد تخفیف خود را وارد کنید</p>
                                    <input name="couponCode" type="text" wire:model="couponCode"
                                           class="cart-Discount-input"/>
                                    <button type="button" wire:click="setCoupon" class="cart-Discount-btn ">ثبت کد
                                        تخفیف
                                    </button>

                                </div>

                                <strong class="text-danger">@error('couponCode')  {{$message}} @enderror</strong>
                                <strong class="text-danger fs-7">{{$errorCuponCode}}</strong>
                                <strong class="text-success " style="font-size: 1rem">{{$successCode}}</strong>


                                <div class="cart-pay">
                                    <span>مبلغ قابل پرداخت</span>
                                    <span id="total-price">{{number_format($total)}} تومان</span>
                                </div>
                                <button class="btn btn-success btn-block mx-auto mt-3">
                                    تایید و پرداخت
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
