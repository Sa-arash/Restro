<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CartPage extends Component
{
    public $products=[],$cartProduct;
    public $total;

    public function mount()
    {
        $this->cartProduct = json_decode(request()->cookie('products'), true) ?? [];
        $this->products= Product::query()->whereIn('id',array_keys($this->cartProduct))->get();


    }
    public function totalUpdate(){
        foreach ($this->products as $product){
            $count=$this->cartProduct[$product->id];
            if ($product->discount_end >= now()->startOfDay()->toDateString()){
                $this->total=($product->price-(($product->price*$product->discount)/100))*$count;
            }else{
                $this->total+=$product->price*$count;
            }
        }
    }


    public function render()
    {
        $this->totalUpdate();
        return view('livewire.cart-page');
    }
}
