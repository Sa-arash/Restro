<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
   
    <main class="container mt-5 mb-5">
        <div class="broudcam mt-5">
            <a href="./../indexsamat/index.html">خانه ></a>
            <a href="#">منو</a>
        </div>
        <div class="container mt-5">
            <ul class="nav nav-tabs">
                @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link menu-item active" data-target="main-course">
                        <img src="./img/diet_706195.png" alt="menu-logo" class="menu-logo" />
                        غذای اصلی
                    </a>
                </li>
                @endforeach
            </ul>
            <div id="main-course" class="product product-container mt-3">
                <!-- محصولات غذای اصلی -->
                <div class="product-card d-flex">
                    <div class="product-image">
                        <img src="./img/julia-joppien-E4ZxCUrEX2g-unsplash.jpg" alt="کوفته برنجی" />
                    </div>
                    <div class="product-info">
                        <h3>کوفته برنجی</h3>
                        <p>برنج سبزی کوفته لپه آرد نخودچی گردو و زرشک و آلو پیاز</p>
                        <div class="d-flex align-items-center">
                            <span class="discount">٪۳۵</span>
                            <span class="original-price ml-2">۱۸۰,۰۰۰</span>
                        </div>
                        <div class="price">۱۴۵,۰۰۰ تومان</div>
                        <div class="wrapper-add-product-and-stars">
                            <button class="add-to-cart mt-3">افزودن به سبد خرید</button>
                            <div class="rating mt-2">
                                <div class="stars">
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card d-flex">
                    <div class="product-image">
                        <img src="./img/julia-joppien-E4ZxCUrEX2g-unsplash.jpg" alt="کوفته برنجی" />
                    </div>
                    <div class="product-info">
                        <h3>کوفته برنجی</h3>
                        <p>برنج سبزی کوفته لپه آرد نخودچی گردو و زرشک و آلو پیاز</p>
                        <div class="d-flex align-items-center">
                            <span class="discount">٪۳۵</span>
                            <span class="original-price ml-2">۱۸۰,۰۰۰</span>
                        </div>
                        <div class="price">۱۴۵,۰۰۰ تومان</div>
                        <div class="wrapper-add-product-and-stars">
                            <button class="add-to-cart mt-3">افزودن به سبد خرید</button>
                            <div class="rating mt-2">
                                <div class="stars">
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="appetizers" class="product product-container mt-3">
                <!-- محصولات پیش غذا -->
                <div class="product-card d-flex">
                    <div class="product-image">
                        <img src="./img/julia-joppien-E4ZxCUrEX2g-unsplash.jpg" alt="کوفته برنجی" />
                    </div>
                    <div class="product-info">
                        <h3>کوفته برنجی</h3>
                        <p>برنج سبزی کوفته لپه آرد نخودچی گردو و زرشک و آلو پیاز</p>
                        <div class="d-flex align-items-center">
                            <span class="discount">٪۳۵</span>
                            <span class="original-price ml-2">۱۸۰,۰۰۰</span>
                        </div>
                        <div class="price">۱۴۵,۰۰۰ تومان</div>
                        <div class="wrapper-add-product-and-stars">
                            <button class="add-to-cart mt-3">افزودن به سبد خرید</button>
                            <div class="rating mt-2">
                                <div class="stars">
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="desserts" class="product product-container mt-3">
                <!-- محصولات دسر -->
                <div class="product-card d-flex">
                    <div class="product-image">
                        <img src="./img/julia-joppien-E4ZxCUrEX2g-unsplash.jpg" alt="کوفته برنجی" />
                    </div>
                    <div class="product-info">
                        <h3>کوفته برنجی</h3>
                        <p>برنج سبزی کوفته لپه آرد نخودچی گردو و زرشک و آلو پیاز</p>
                        <div class="d-flex align-items-center">
                            <span class="discount">٪۳۵</span>
                            <span class="original-price ml-2">۱۸۰,۰۰۰</span>
                        </div>
                        <div class="price">۱۴۵,۰۰۰ تومان</div>
                        <div class="wrapper-add-product-and-stars">
                            <button class="add-to-cart mt-3">افزودن به سبد خرید</button>
                            <div class="rating mt-2">
                                <div class="stars">
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="drinks" class="product product-container mt-3">
                <!-- محصولات نوشیدنی -->
                <div class="product-card d-flex">
                    <div class="product-image">
                        <img src="./img/julia-joppien-E4ZxCUrEX2g-unsplash.jpg" alt="کوفته برنجی" />
                    </div>
                    <div class="product-info">
                        <h3>کوفته برنجی</h3>
                        <p>برنج سبزی کوفته لپه آرد نخودچی گردو و زرشک و آلو پیاز</p>
                        <div class="d-flex align-items-center">
                            <span class="discount">٪۳۵</span>
                            <span class="original-price ml-2">۱۸۰,۰۰۰</span>
                        </div>
                        <div class="price">۱۴۵,۰۰۰ تومان</div>
                        <div class="wrapper-add-product-and-stars">
                            <button class="add-to-cart mt-3">افزودن به سبد خرید</button>
                            <div class="rating mt-2">
                                <div class="stars">
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-16.png" alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                    <img src="./img/icons8-star-24.png" width="16px" height="16px"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal HTML -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="productModalLabel">جزئیات محصول</h5>
                </div>
                <div class="modal-body">
                    <div class="top-item-box">
                        <img src="" alt="img" class="img-product" id="modalProductImage" />
                    </div>
                    <div class="bottom-item-box">
                        <div class="title-box-item">
                            <h3 id="modalProductName"></h3>
                        </div>
                        <p id="modalProductDescription"></p>
                        <div class="d-flex align-items-center">
                            <span class="discount" id="modalProductDiscount"></span>
                            <span class="original-price ml-2" id="modalProductOriginalPrice"></span>
                        </div>
                        <div class="price" id="modalProductPrice"></div>
                        <div class="wrapper-add-product-and-stars">
                            <a class="btn-add-to-product">افزودن به سبد خرید</a>
                            <div class="rating mt-2">
                                <div class="stars" id="modalProductStars"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('front/js/menu.js') }}"></script>
</div>
