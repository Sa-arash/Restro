<div>
    <div class="container wrapper-main ">
        <div class="cart-container-pay-basket text-center">
            <div class="RouteShopping mb-2">
                <div class="box1">
                    <img src="{{asset('front/image/shopping-cart.png')}}" alt=""/>
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

            <div class="container ">
                <div class="row">
                    @if($step===1)
                        @foreach($products as $product)
                        <div class="basket-product">
                                <div class="product-card d-flex">
                                    <div class="product-image-shopping">
                                        <img src="{{asset('images/'.$product->images)}}" alt="{{$product->title}}" class="product-image-shopping"/>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="title-product"><a href="{{route('product.page',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                        <p class="details-product">{{\Illuminate\Support\Str::limit($product->description,30)}}</p>
                                        @if($product->discount_end >= now()->startOfDay()->toDateString())
                                            <div class="d-flex align-items-center">
                                                <span class="discount">%{{$product->discount}}</span>
                                                <span class="original-price ml-2">{{number_format($product->price)}}</span>
                                            </div>
                                            <div class="price">{{number_format($product->price-(($product->price*$product->discount)/100))}}تومان</div>
                                        @else
                                            <div class="price">{{number_format($product->price)}} تومان</div>
                                        @endif
                                        <div class="wrapper-add-product-and-stars">
                                            <div class="rating mt-2">
                                                <div class="stars">
                                                    @php
                                                        $commentCount=$product->comments->where('is_show',1)->count()
                                                    @endphp
                                                    @if($commentCount)
                                                        @php
                                                           $avg= $product->comments->where('is_show',1)->sum('star') /$commentCount;
                                                        @endphp
                                                        {{$avg}}
                                                            <i class="bi bi-star-fill"></i>
                                                        <span class="text-dark">({{$product->comments->where('is_show',1)->count()}})</span>
                                                    @else
                                                        0<i class="bi bi-star-fill"></i>
                                                        <span class="text-dark">({{$product->comments->where('is_show',1)->count()}})</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                            @if(!isset($products[0]))
                                <p>شما در حال حاضر هیچ سفارشی ثبت نکرده‌اید!</p>
                            @endif
                        <div class="btn-box">
                            <a href="./../menu/menu.html" class="btn btn-primary btn-menu"
                            >منوی رستوران</a
                            >
                            @if(isset($products[0]))
                            <button wire:click="stepTwe()" class="btn btn-primary btn-menu">ادامه ی خرید</button>
                            @endif
                        </div>
                    @elseif($step===2)
                        <div class="justify-content-center">
                            <div class="cart-Discount  ">
                                @guest()
                                        <p class="cart-Discount-title">نام و نام خانوادگی</p>
                                        <input required wire:model="name" type="text"
                                               class="form-control  w-75  m-auto  p-1 rounded "/>
                                        <strong class="text-danger">@error('name')  {{$message}} @enderror</strong>
                                        <p class="cart-Discount-title">شماره تلفن</p>
                                        <input required  wire:model="phoneNumber" type="text"
                                               class="form-control  w-75  m-auto   p-1 rounded "/>
                                        <strong class="text-danger">@error('phoneNumber')  {{$message}} @enderror</strong>
                                        <p class="cart-Discount-title">میز</p>
                                        <select  wire:model="tb"  class="form-select  w-75  m-auto">
                                            <option   value="">انتخاب میز </option>
                                            @foreach($tables as $table)
                                                <option @if($table->status->name==="Use")  disabled
                                                        @endif value="{{$table->id}}">{{$table->title }}</option>
                                            @endforeach
                                        </select>
                                    <strong class="text-danger">@error('tb')  {{$message}} @enderror</strong>

                                @else
                                    <p class="cart-Discount-title">میز</p>
                                    <select wire:model="tb" id="" class="form-select  w-75  m-auto">
                                        <option   value="">انتخاب میز </option>
                                    @foreach($tables as $table)
                                            <option @if($table->status->name==="Use")  disabled
                                                    @endif value="{{$table->id}}">{{$table->title}}</option>
                                        @endforeach
                                    </select>
                                    <strong class="text-danger">@error('tb')  {{$message}} @enderror</strong>

                                @endguest
                            </div>
                        </div>
                        <div class="btn-box mt-2">
                            <button type="button"
                                wire:click="stepThree()"
                                class="btn btn-primary btn-menu"
                            >ادامه ی خرید
                            </button
                            >
                        </div>
                    @elseif($step===3)
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
                                        value="0" wire:model="method"
                                    />
                                    <label class="form-check-label" for="payAtRestaurant">
                                        <img wire:click="paymentMethod(0)"
                                            src="{{asset('front/image/wallet-2.png')}}"
                                            style="margin-left: 10px; width: 25px; height: 25px"
                                            alt=""
                                        />
                                        پرداخت در رستوران
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="onlinePayment"
                                           wire:model="method" value="1" checked/>
                                    <label class="form-check-label" for="onlinePayment">
                                        <img src="{{asset('front/image/card-pos.png')}}"
                                             style="margin-left: 10px; width: 25px; height: 25px" alt=""/>
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
                            <div class="cart-container-pay-basket ">
                                <div class="title-cart">
                                    <h6>سبد خرید (<span id="cart-count">{{count($products)}}</span>)</h6>
                                    <img wire:click="deleteAll" src="{{asset('front/image/trash.png')}}" alt=""
                                         id="trash-btn"/>
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
                                                        <span class="item-price"
                                                              style="margin-top: 10px; color: #898989">{{number_format($product->price-(($product->price*$product->discount)/100))}} تومان</span>
                                                    @else
                                                        <span class="item-price"
                                                              style="margin-top: 10px; color: #898989">{{number_format($product->price)}} تومان</span>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    <livewire:add-to-cart :$product :key="$product->id"/>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div     class="w-100 " >

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
                                    <button class="btn btn-success btn-block mx-auto mt-3" wire:click="save">
                                        تایید و پرداخت
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
