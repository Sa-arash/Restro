<?php

namespace App\Livewire\Page;

use App\Models\Comment;
use Livewire\Component;

class ProductPage extends Component
{

    public $product;
    public $text;
    public function save(){

        dd($this->text);
        Comment::query()->create([
            'user_id'=>auth()->id,
            'product_id'=>$this->product->id,
            'comment'=>$this->text,
            'star',
        ]);
    }

    public function render()
    {
        return view('livewire.page.product-page');
    }
}
