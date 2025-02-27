<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function main()
    {
        $categories=Category::query()->get();
        $products=Product::query()->with('comments')->where('special_offer',1)->limit(8)->get();
        return view('front/pages/home',compact('categories','products'));
    }
    public function productPage($product){

        $product=Product::query()->with('comments')->findOrFail($product);

        return view('front/pages/product-page',compact('product'));
    }
}
