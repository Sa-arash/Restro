<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" />
    <link rel="shortcut icon" href="{{ asset('front/image/SAMAT.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('front/image/user.png') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/jalali.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}" />
    @livewireStyles

    <title>@yield('title')</title>
</head>

<body dir="rtl">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary d-none d-lg-block">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('front/image/SAMAT.png') }}" alt="samatlogo" class="logosamat-orginal" /></a>
                <div class="collapse navbar-collapse response-box-header" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">صفحه اصلی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu')}}" aria-current="page">منو</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact')}}">تماس با ما</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}">درباره ما</a>
                        </li>
                    </ul>
                    <form class="d-flex response-form-icon" role="search">
                        @guest
                            <a type="button" class="btn btn-secondary margin-right-btn"
                                href="{{ route('login') }}">ورود</a>
                            <a type="button" class="btn btn-dark margin-right-btn" href="{{ route('register') }}">عضویت</a>
                        @endguest
                        <a href="{{ route('cart.page') }}" style="display: flex">
                            <img src="{{ asset('front/image/Icon1.png') }}" class="margin-right-btn icon-style"
                                alt="logo" />
                        </a>
                        @auth

                            <a href="{{ route('profile') }}" style="display: flex">
                                <img src="{{ asset('front/image/Icon2.png') }}" class="margin-right-btn icon-style"
                                    alt="" />
                            </a>
                        @endauth
                    </form>
                </div>
            </div>
        </nav>

        <nav class="responsive-mobile-header d-lg-none">
            <div class="wrapper-responsive-mobile">
                <div class="left-responsive-mobile">
                    <img src="{{ asset('front/image/SAMAT.png') }}" alt="SAMAT" class="samatLogo" />
                </div>
                @guest


                    <div class="right-responsive-mobile">
                        <a type="button" class="btn btn-secondary margin-right-btn" href="{{ route('login') }}">ورود</a>
                        <a type="button" class="btn btn-dark margin-right-btn" href="{{ route('login') }}">عضویت</a>
                    </div>
                @endguest
            </div>
        </nav>
        <nav class="responsive-mobile d-lg-none box-shadow">
            <div class="wrapper-responsive-mobile">
                <a href="{{route('home')}}" class="box-reponsive active-mobile-responsive-header">
                    <i class="bi bi-house-door"></i>
                    <span style="font-size: 10px">خانه</span>
                </a>
                <a href="{{route('menu')}}" class="box-reponsive"><i class="bi bi-list"></i><span
                        style="font-size: 10px">منو</span>
                </a>
                <a href="{{route('cart.page')}}" class="box-reponsive"><i class="bi bi-cart"></i><span
                        style="font-size: 10px">سبد خرید</span>
                </a>
                <a href="{{route('about')}}" class="box-reponsive">
                    <i class="bi bi-info-circle"></i><span style="font-size: 10px">درباره ما</span>
                </a>
                @auth

                    <a href="{{ route('profile') }}" class="box-reponsive">
                        <i class="bi bi-person"></i>
                        <span style="font-size: 10px">پروفایل کاربری</span>
                    </a>
                @endauth
            </div>
        </nav>
    </header>
    @yield('body')

    <footer class="text-center text-lg-start bg-body-tertiary text-muted footer">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span style="font-size: 28px">سماط</span>
            </div>

            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>

        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3" style="text-align: justify; font-size: 19px">
                    <div class="col-6 col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 col-footer-responsive-text">
                        <h6 class="text-uppercase fw-bold mb-4">راه های ارتباط با ما</h6>
                        <p>۰۹۱۵۲۶۶۱۴۳۶</p>
                        <p>samat@gmail.com</p>
                        <p>32033333</p>
                    </div>

                    <div class="col-6 col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 col-footer-responsive-text">
                        <h6 class="text-uppercase fw-bold mb-4">خدمات مشتریان</h6>
                        <p>
                            <a href="{{ route('questions') }}" class="text-reset">سوالات متداول</a>
                        </p>
                        <p>
                            <a href="{{route('about')}}" class="text-reset">درباره ما</a>
                        </p>
                        <p>
                            <a href="{{route('contact')}}" class="text-reset">ارتباط با ما</a>
                        </p>
                        <p>
                            <a href="{{route('menu')}}" class="text-reset">منو</a>
                        </p>
                        @guest

                            <p>
                                <a href="{{ route('register') }}" class="text-reset">عضویت</a>
                            </p>
                            <p>
                                <a href="{{ route('login') }}" class="text-reset">ورود</a>
                            </p>
                        @endguest
                    </div>

                    <div class="col-6 col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 col-footer-responsive-text">
                        <h6 class="text-uppercase fw-bold mb-4">ساعت کاری</h6>
                        <p>
                            <a href="#!" class="text-reset">۱۲ الی ۱۶</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">۲۰ الی ۲۴</a>
                        </p>
                    </div>

                    <div class="col-6 col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 col-footer-responsive-text">
                        <h6 class="text-uppercase fw-bold mb-4">در باره ما</h6>
                        <p>
                            استان خراسان جنوبی، شهر بیرجند ، روستای چهارده ، انتهای خیابان
                            غفاری دهکده گردشگری بادامشک رستوران سنتی سماط
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-4" style="background-color: #14463d; color: white">
            حق نشر و کپی‌رایت © ۱۴۰۳ وب‌سایت رستوران سماط - تمامی حقوق محفوظ است.
        </div>
    </footer>

    <script src="{{ asset('front/js/swiper.js') }}"></script>
    <script src="{{ asset('front/js/jalali.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.js') }}"></script>
    @livewireScripts
    <script src="{{ asset('front/js/app.js') }}"></script>
</body>

</html>
