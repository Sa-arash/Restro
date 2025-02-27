@extends('front.master')
@section('title')
    سماط-
@endsection
@section('body')
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="wrapper-product">
                    <div class="col-md-6">

                        <img
                            src="{{asset('images/'.$product->images)}}"
                            alt="{{$product->title}}"
                            class="product-image"
                        />
                    </div>
                    <div class="col-md-6 right">
                        <h3 class="title-product-buy">{{$product->title}}</h3>
                        <p class="details-product-buy">{{$product->description}}</p>
                        <p class="border-bottom"><strong>تعداد باقی مانده:</strong> 10 عدد</p>
                        <p>
                            @if($product->discount_end >= now()->startOfDay()->toDateString())
                                <del class="text-danger">{{$product->price}} تومان</del>
                                <span class="badge text-bg-success">{{$product->discount}}% تخفیف</span>
                        <p>{{number_format($product->price-(($product->price*$product->discount)/100))}} تومان</p></p>
                        @else
                            <p>{{number_format($product->price)}} تومان</p></p>
                        @endif
                        <button class="btn btn-add">افزودن</button>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h4>نظرات کاربران</h4>

                <div class="wrapper-review col-12">
                    <button class="btn btn-add" id="add-review">ثبت نظر</button>
                    @foreach($product->comments->where('is_show',1)->sortByDesc('id') as $comment)
                    <div class="review">
                        <p>
                            <strong>{{$comment->user->name}}</strong>
                            <span class="text-muted">{{verta($comment->created_at)->format('d F Y')}}</span>
                            <span class="badge badge-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
                        </p>
                        <p>خیلی عالی بود هم طعم غذا هم کیفیتش</p>
                        <p class="text-primary">
                            پاسخ مدیر رستوران: سلام سرکار خانم فاطمه عزیز نوش جانتان و سپاس از
                            اینکه نظرتان را با ما در میان گذاشتید
                        </p>
                    </div>
                    @endforeach
                    <div class="review">
                        <p>
                            <strong>محدثه</strong>
                            <span class="text-muted">26 بهمن 1403</span>
                            <span class="badge badge-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
                        </p>
                        <p>خیلی عالی بود هم طعم غذا هم کیفیتش</p>
                        <p class="text-primary">
                            پاسخ مدیر رستوران: سلام سرکار خانم فاطمه عزیز نوش جانتان و سپاس از
                            اینکه نظرتان را با ما در میان گذاشتید
                        </p>
                    </div>
                    <div class="review">
                        <p>
                            <strong>محدثه</strong>
                            <span class="text-muted">26 بهمن 1403</span>
                            <span class="badge badge-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
                        </p>
                        <p>خیلی عالی بود هم طعم غذا هم کیفیتش</p>
                        <p class="text-primary">
                            پاسخ مدیر رستوران: سلام سرکار خانم فاطمه عزیز نوش جانتان و سپاس از
                            اینکه نظرتان را با ما در میان گذاشتید
                        </p>
                    </div>
                    <div class="review">
                        <p>
                            <strong>محدثه</strong>
                            <span class="text-muted">26 بهمن 1403</span>
                            <span class="badge badge-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
                        </p>
                        <p>خیلی عالی بود هم طعم غذا هم کیفیتش</p>
                        <p class="text-primary">
                            پاسخ مدیر رستوران: سلام سرکار خانم فاطمه عزیز نوش جانتان و سپاس از
                            اینکه نظرتان را با ما در میان گذاشتید
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

