<div>

    <main class="container mt-5 mb-5">
        <div class="broudcam mt-5">
            <a href="href="{{ route('home') }}">خانه ></a>
            <a href="#">منو</a>
        </div>
        <div class="container mt-5">
            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link menu-item active"
                        data-target="all">
                        <img src="{{ asset('images/default.jpg') }}" alt="menu-logo"
                            class="menu-logo" />
                      همه
                    </a>
                </li>

                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link menu-item"
                            data-target="{{ $category->slug }}">
                            <img src="{{ asset('images/' . ($category->image ?? 'default.jpg')) }}" alt="menu-logo"
                                class="menu-logo" />
                            {{ $category->title }}
                        </a>
                    </li>

                    
                @endforeach
            </ul>
            <div id="all" class="product product-container mt-3">
               
                @foreach ($products as $product)
                    <div class="product-card " >
                        <div class="product-image">
                            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="کوفته برنجی" />
                        </div>
                        <div class="product-info">
                            <h3>{{$product->title}}</h3>
                            <p>{{$product->desctiprion}}</p>
                            <div class="d-flex align-items-center">
                                @if ($product->discount)
                                <span class="discount">{{$product->discount}}%</span>
                                <span class="original-price ml-2">{{ $product->price + ($product->price * ($product->discount / 100)) }} </span>
                                @else
                                <span class="discount"></span>
                                <span class="original-price ml-2"></span>
                                @endif
                            </div>
                            <div class="price">{{$product->price}}</div>
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
                @endforeach



            </div>

            @foreach ($categories as $category)
                <div id="{{ $category->slug }}" class="product product-container mt-3" style="display: none">
                    @forelse ($category->products as $product)
                  
                    <div class="product-card " >
                        <div class="product-image">
                            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="کوفته برنجی" />
                        </div>
                        <div class="product-info">
                            <h3>{{$product->title}}</h3>
                            <p>{{$product->desctiprion}}</p>
                            <div class="d-flex align-items-center">
                                @if ($product->discount)
                                <span class="discount">{{$product->discount}}%</span>
                                <span class="original-price ml-2">{{ $product->price + ($product->price * ($product->discount / 100)) }} </span>
                                @endif
                            </div>
                            <div class="price">{{$product->price}}</div>
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
                      
                   @empty
                   محصولی در این دسته بندی نیست 
                    @endforelse



                </div>
            @endforeach
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
