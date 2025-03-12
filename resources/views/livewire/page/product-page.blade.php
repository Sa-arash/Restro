<div>

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
                    @if($product->inventory <10)
                    <p class="border-bottom"><strong>تعداد باقی مانده:</strong> {{$product->inventory}} عدد</p>
                    @else
                        <p class="border-bottom"></p>
                    @endif
                    <p>@if($product->discount_end >= now()->startOfDay()->toDateString())
                            <del class="text-danger">{{number_format($product->price)}} تومان</del>
                            <span class="badge text-bg-success">{{$product->discount}}% تخفیف</span>
                    <p>{{number_format($product->price-(($product->price*$product->discount)/100))}} تومان</p></p>
                    @else
                        <p>{{number_format($product->price)}} تومان</p></p>
                    @endif
                    <livewire:add-to-cart :product="$product"/>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h4>نظرات کاربران</h4>

            <div class="wrapper-review col-12" >
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#sendComment" data-bs-whatever="@mdo">ثبت نظر</button>
                @foreach($product->comments->where('is_show',1)->sortByDesc('id') as $comment)
                    <div class="review">
                        <p class="d-inline">
                            <strong>{{$comment->user->name}}</strong>
                        <p class="text-muted d-inline p-0">{{verta($comment->created_at)->format('d F Y')}}</p>
                        <span class="badge badge-warning">
                            @for($i=1;$i<=$comment->star;$i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
              </span>
                        </p>
                        <p>{{$comment->comment}}</p>
                        <p class="text-primary">{{$comment->reply}}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div    wire:ignore class="modal fade" id="sendComment" tabindex="-1" aria-labelledby="sendCommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center align-content-center">
                    <h5 class="modal-title text-center" id="sendCommentLabel">ثبت نظر</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" wire:model="text" id="message-text" placeholder="نظر شما"></textarea>
                            <div>@error('text') {{ $message }} @enderror</div>

                        </div>
                        <div id="stars" class="mx-auto">
                            <i class="bi bi-star star" wire:click="setStar('1')" data-star="1"></i>
                            <i class="bi bi-star star" wire:click="setStar('2')" data-star="2"></i>
                            <i class="bi bi-star star" wire:click="setStar('3')" data-star="3"></i>
                            <i class="bi bi-star star" wire:click="setStar('4')" data-star="4"></i>
                            <i class="bi bi-star star" wire:click="setStar('5')" data-star="5"></i>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0 mx-auto   ">
                    <button type="button" style="background: #7066e0;color: white" class="btn " data-bs-dismiss="modal" wire:click="save">ثبت نظر</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </div>
</div>
