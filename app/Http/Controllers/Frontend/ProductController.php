<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function showDetails($slug){
        $product =  Product::where('slug',$slug)->where('active',1)->first();

        if($product==NULL){
            return redirect()->route('frontend.home');
        }
        $data =[];
        $data['product'] = $product;
        return view('frontend.products.details', $data);
    }
}
