<?php

namespace App\Livewire\Page;

use App\Models\Comment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductPage extends Component
{

    public $product;
    #[Validate('required|min:2')]
    public $text;
    #[Validate('required|min:1')]
    public $star;
    public $showModal;

    public function setStar($star){
       if ($star<=5 and $star >0){
           $this->star=$star;
       }
    }
    public function save(){
        $this->validate();
        Comment::query()->create([
            'user_id'=>auth()->id(),
            'product_id'=>$this->product->id,
            'comment'=>$this->text,
            'star'=>$this->star,
        ]);
        $this->reset('text');
        $this->showModal = false;

    }


    public function render()
    {
        return view('livewire.page.product-page');
    }
}
