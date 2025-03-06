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
                    <img src="./img/tick-square.png" alt=""/>
                    <p
                        class="title-basket-detailes"
                        id="responsive-title-basket-detailes"
                    >
                        تکمیل اطلاعات -----------
                    </p>
                </div>
                <div class="box3">
                    <img src="./img/wallet-2.png" alt=""/>
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
                                    src="./img/wallet-money.png"
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
                                />
                                <label class="form-check-label" for="payAtRestaurant">
                                    <img
                                        src="./img/wallet-2.png"
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
                                    checked
                                />
                                <label class="form-check-label" for="onlinePayment">
                                    <img
                                        src="./img/card-pos.png"
                                        style="margin-left: 10px; width: 25px; height: 25px"
                                        alt=""
                                    />
                                    پرداخت اینترنتی
                                </label>
                            </div>
                        </div>
                        <div class="payment-gateways">
                            <h5>انتخاب درگاه پرداخت</h5>
                            <img src="./img/Bank.png" alt="بانک سامان"/>
                            <img src="./img/Bank.png" alt="بانک ملت"/>
                            <p style="color: #7d7c7c">
                                پرداخت از طریق کلیه کارت‌های عضو شتاب امکان‌پذیر است.‌
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
                                <img src="./img/trash.png" alt="" id="trash-btn"/>
                            </div>
                            <div class="wrapper-box-cart">
                                @foreach($products as $product)

                                <div class="cart-item">
                                    <div class="basket-box">
                                        <div class="basket-box-right">
                                            <span>{{$product->title}}</span>
                                            <span
                                                class="item-price"
                                                data-price="140000"
                                                style="margin-top: 10px; color: #898989"
                                            >{{$product->title}} تومان</span
                                            >
                                        </div>
                                        <div class="">
                                            <livewire:add-to-cart  :product="$product" />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="cart-Discount">
                                <p class="cart-Discount-title">کد تخفیف خود را وارد کنید</p>
                                <input type="text" name="" class="cart-Discount-input"/>
                                <button class="cart-Discount-btn">ثبت کد تخفیف</button>
                            </div>
                            <div class="cart-pay">
                                <span>مبلغ قابل پرداخت</span>
                                <span id="total-price">542,000 تومان</span>
                            </div>
                            <button class="btn btn-success btn-block mt-3">
                                تایید و پرداخت
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
