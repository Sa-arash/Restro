<div>
    @if($status)
        <button wire:click="addToCart()" class="btn w-100 btn-add">افزودن به سبد خرید</button>
    @else
        <div class=" btn-add ">
            <div wire:loading class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
            <div wire:loading.class="d-none" class="d-flex">
                <button class="btn text-white" wire:loading.attr="disabled" wire:click="plus()"><i>+</i></button>
                <span class="p-2">{{$count}}</span>
                @if($count>1)
                    <button class="btn text-white" wire:click="minus()"><i>-</i></button>
                @else
                    <button class="btn text-white" wire:click="delete ">
                        <svg class="m-auto" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                        </svg></button>
                @endif
            </div>
        </div>

    @endif
</div>
