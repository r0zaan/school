<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function indexPage(){
        return view('frontend.index');
    }
    public function productsPage(){
        $products = Product::orderBy('name','ASC')->get()->map(function ($product){
            $product['discount_price'] = number_format((float)$product->price - (($product->price*$product->discount_percentage)/100), 2, '.', ',');
            $product['price'] = number_format((float)$product->price, 2, '.', ',');
            return $product;
        });
        return view('frontend.products',compact('products'));
    }
    public function singleProduct($slug){
        $product = Product::where('slug',$slug)->first();
        $product['discount_price'] = number_format((float)$product->price - (($product->price*$product->discount_percentage)/100), 2, '.', ',');
        $product['price'] = number_format((float)$product->price, 2, '.', ',');
        return view('frontend.singleProduct',compact('product'));
    }
}
