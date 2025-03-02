<div>
    @if($status)
        <button wire:click="addToCart()" class="btn btn-add">افزودن</button>
    @else
        <div wire:click="">
            <div wire:loading class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <button   class="btn"   wire:loading.attr="disabled" wire:click="plus()"> <i>+</i></button>
            <span class="p-2">{{$count}}</span>
            <button class="btn" wire:click="minus()"> <i>-</i></button>
        </div>

    @endif
</div>
