<?php

namespace App\Livewire\Page;

use Livewire\Component;

class Menu extends Component
{
    public $categories;
    public $products;
    public function render()
    {
        return view('livewire.page.menu');
    }
}
