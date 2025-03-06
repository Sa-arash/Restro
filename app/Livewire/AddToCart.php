<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $products = [];
    public $status = true;
    public $count;

    public function mount()
    {
        $this->products = json_decode(request()->cookie('products'), true) ?? [];
        if (isset($this->products[$this->product->id])) {
            $this->status = false;
            $this->count = $this->products[$this->product->id];
        }
    }

    public function addToCart()
    {
        $this->updateProductCount(1);
        $this->status = false;
    }

    public function plus()
    {
        $this->updateProductCount($this->count + 1);
    }

    public function minus()
    {
        if ($this->count > 1) {
            $this->updateProductCount($this->count - 1);
        }
    }

    private function updateProductCount($count)
    {
        $this->products = json_decode(request()->cookie('products'), true) ?? [];
        $this->products[$this->product->id] = $count;
        $this->saveProductsToCookie();
        $this->count = $count;
    }

    private function saveProductsToCookie()
    {
        Cookie::queue('products', json_encode($this->products), 60);
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
