<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CartPage extends Component
{
    public $products=[],$cartProduct;

    public function mount()
    {
        $this->cartProduct = json_decode(request()->cookie('products'), true) ?? [];
        $this->products= Product::query()->whereIn('id',array_keys($this->cartProduct))->get();
    }


    public function render()
    {
        return view('livewire.cart-page');
    }
}
