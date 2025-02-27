@extends('front.master')
@section('title')
    سماط
@endsection
@section('body')
<nav class="nav-bottom-index">
    <h1>خوش آمدید به رستوران سماط</h1>
    <p class="wellcom-title">
        در رستوران سماط، ما به شما فرصتی می‌دهیم تا با هر لقمه سفری به دنیای
        طعم‌ها و عطرهای بی‌نظیر آغاز کنید. از بهترین مواد اولیه و دستورهای خاص
        سرآشپزمان، تجربه‌ای بی‌مانند و بی‌نظیر را فراهم کرده‌ایم.
    </p>
</nav>
<main class="mt-5">
    <section class="menu mt-5">
        <h2>منو</h2>
        <div class="menu-box">
            <div class="container-pishnahad">
                <div class="content-wrapper">
                    <div class="center-content">
                        <ul>
                            @foreach($categories as $category)
                                <li>{{$category->title}}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutus-index mt-5">
        <div class="container">
            <p class="farayand-title">فرآیند کاری ما</p>
            <p class="sefaresh-title">سفارش آسان در 3 مرحله</p>
            <div class="box-aboutus">
                <div class="seemenu">
                    <img src="{{asset('front/image/Border.png')}}" alt="" class="img-about"/>
                    <p class="text-about">سفارش آسان در 3 مرحله</p>
                </div>
                <div class="seefood">
                    <img src="{{asset('front/image/Border1.png')}}" alt="" class="img-about"/>
                    <p class="text-about">غذای مورد نظر را انتخاب فرمایید</p>
                </div>
                <div class="sabtsefaresh">
                    <img src="{{asset('front/image/Border3.png')}}" alt="" class="img-about"/>
                    <p class="text-about">سفارش خود را ثبت کنید</p>
                </div>
            </div>
        </div>
    </section>
    @if($products->count())
        <section class="best-food container mt-5">
            <div class="top-best">
                <h2 class="top-best-title">پیشنهاد ویژه ما</h2>
            </div>
            <div class="bottom-best">
                @foreach($products as $product )
                    <div class="food-card">
                        <a href="{{route('product.page',['id'=>$product->id])}}">
                            <img
                                src="{{asset('images/'.$product->images)}}" alt="Food Image" class="food-image"
                            />
                            <div class="food-info">
                                <div class="food-rating">
                                    0⭐
                                    @if($product->comments->where('is_show',1)->sum('star'))
                                    {{$product->comments->where('is_show',1)->sum('star')/ $product->comments->where('is_show',1)->count()}}
                                    @endif
                                </div>

                                <h3 class="food-title">{{$product->title}}</h3>
                                <p class="food-description">{{\Illuminate\Support\Str::limit($product->description,20)}}</p>
                                <div class="food-price">
                                    <p>{{number_format($product->price)}} تومان</p>
                                    <img
                                        src="{{asset('front/image/cart.png')}}"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </section>
    @endif
    <section class="ashpaz mt-5">
        <h2>آشپز مجموعه</h2>
        <div class="box-ashpaz">
            <div class="box-flex">
                <div class="ashpaz-image">
                    <img src="{{asset('front/image/chef.png')}}" alt="Chef Image" class="Chef-Image"/>
                </div>
                <div class="ashpaz-info">
                    <h3
                        class="resume-chef-title"
                        style="
                  font-size: 30px;
                  font-weight: bold;
                  color: #0e0b0b;
                  margin-bottom: 20px;
                "
                    >
                        رزومه آشپز
                    </h3>
                    <p
                        style="font-size: 24px; color: white; margin-bottom: 20px"
                        class="resume-chef"
                    >
                        آشپز ما با بیش از ۲۰ سال تجربه در زمینه آشپزی، بهترین و
                        خوشمزه‌ترین غذاها را برای شما آماده می‌کند. او در رستوران‌های
                        معتبر بین‌المللی کار کرده و جوایز متعددی را کسب کرده است.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery container mt-5">
        <h2>گالری تصاویر</h2>
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset('front/image/1 1.png')}}" class="gallery-responsive" alt=""/>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('front/image/1 1.png')}}" class="gallery-responsive" alt=""/>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="mt-5 reservation">
        <h2>درخواست رزرو</h2>
        <div class="reserv-box">
            <h2 style="color: white">خوش آمدید</h2>
            <form action="" class="form-box-reserv">
                <div class="date">
                    <input
                        class="datapicker"
                        data-jdp
                        placeholder="لطفا تاریخ خود را انتخاب کنید"
                        style="color: white"
                    />
                </div>
                <div class="hourse">
                    <select
                        class="datapicker"
                        class="form-select"
                        aria-label="Default select example"
                        style="color: white"
                    >
                        <option selected style="color: #ccc">
                            ساعت خود را انتخاب کنید
                        </option>
                        <option value="1">13</option>
                        <option value="2">14</option>
                        <option value="3">17</option>
                        <option value="3">18</option>
                        <option value="3">19</option>
                        <option value="3">20</option>
                        <option value="3">21</option>
                        <option value="3">22</option>
                        <option value="3">23</option>
                    </select>
                </div>
                <div class="numbertable">
                    <select
                        class="datapicker"
                        style="color: white"
                        class="form-select"
                        aria-label="Default select example"
                    >
                        <option selected style="color: #ccc">
                            تعداد افراد را وارد کنید
                        </option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                        <option value="3">6</option>
                        <option value="3">7</option>
                        <option value="3">بیشتر ...</option>
                    </select>
                </div>
                <div class="phone">
                    <input
                        type="text"
                        class="datapicker"
                        placeholder="لطفا شماره تلفن خود را وارد کنید"
                    />
                </div>
                <div class="nameandfamily">
                    <input
                        type="text"
                        class="datapicker"
                        placeholder="لطفا نام و نام خانوادگی خود را وارد کنید"
                    />
                </div>
            </form>
            <button class="send-reserv-btn">ارسال درخواست</button>
        </div>
    </section>
</main>
@endsection

