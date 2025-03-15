@extends('front.master')
@section('title')
    درباره ما
@endsection
@section('body')

 
<nav class="bottom-nav-aboutus">
    <div class="title-aboutus">
      <p>درباره سماط بیشتر بدانید!</p>
    </div>
  </nav>

  <main class="aboutUs">
    <section class="about container">
      <div class="row">
        <div class="col-lg-6 col-md-12 right-about">
          <h2>درباره‌ما</h2>
          <p>
            رستوران سماط در سال 1403 افتتاح گردید. و این مجموعه همواره با
            ارائه غذاهای باکیفیت و سرویس سریع و به موقع در تلاش برای جلب رضایت
            مشتریان خود بوده است. اولویت مجموعه جلب رضایت مشتریان بوده است.
            دراین خصوص سماط همیشه در تلاش بوده تا کیفیت غذاهای خود را دربهترین
            حالت نگه داشته و حتی با نوسانات قیمت‌های مواد اولیه در بازار قیمت
            خود را ثابت نگه دارد. سماط دارای محیطی بسیار شیک و مدرن می‌باشد و
            برای برگزاری جشن‌های کوچک و بزرگ شما مشتریان عزیز توانایی پذیرایی
            با کیفیت بالا را دارد. سالن پذیرایی در دو طبقه مجزا به همراه راه
            پله مدرن و آسانسور برای افراد کم‌توان و سال خورده آماده ارائه
            سرویس به شما عزیزان می‌باشند. چشم انداز: درآینده‌ای نزدیک
            تالارپذیرایی شعبات راه اندازی شده و آماده برگزاری جشن‌ها و
            مراسم‌های بزرگ شما خواهند بود. به امید آن روز که همه ایرانیان سالم
            و سلامت باشند.
          </p>
        </div>
        <div class="col-lg-6 col-md-12 left-about">
          <img src="{{ asset('front/image/Image.png')}}" alt="" class="img-fluid" />
        </div>
      </div>
    </section>
    <section class="feature">
      <div class="wrapper-details container">
        <div class="col-md-12 col-12 box-details">
          <div class="box-details">
            <img src="{{ asset('front/image/user.png') }}" alt="details" />
            <p>پرسنلی مجرب و حرفه‌ای</p>
          </div>
          <div class="border"></div>
          <div class="box-details">
            <img src="{{ asset('front/image/diagram.png') }}" alt="details" />
            <p>کیفیت بالای غذاها</p>
          </div>
          <div class="border"></div>
          <div class="box-details">
            <img src="{{ asset('front/image/home-wifi.png') }}" alt="details" />
            <p>محیطی دلنشین و آرام</p>
          </div>
          <div class="border"></div>
          <div class="box-details">
            <img src="{{ asset('front/image/menu-board.png') }}" alt="details" />
            <p>منوی متنوع</p>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
