<div>
    @if($status)
        <button wire:click="addToCart()" class="btn btn-add">افزودن</button>
    @else
        <div class=" btn-add ">
            <div wire:loading class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
            <div wire:loading.class="d-none" class="d-flex">
                <button class="btn text-white" wire:loading.attr="disabled" wire:click="plus()"><i>+</i></button>
                <span class="p-2">{{$count}}</span>
                <button class="btn text-white" wire:click="minus()"><i>-</i></button>
            </div>
        </div>

    @endif
</div>
