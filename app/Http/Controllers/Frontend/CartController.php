<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showCart(){
        $data = [];
        $data['cart'] = session()->has('cart')? session()->get('cart'): [];
        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request){
        try{
            $this->validate($request,[
                'product_id'    =>  'required'
            ]);
        }catch(ValidationException $e){
            return redirect()->back();
        }

        $cart = [];

        $product = Product::findOrFail($request->input('product_id'));
        if(session()->has('cart')){
            $cart = session()->get('cart');
            $unit_price =  ($product->sale_price != NULl) ? $product->sale_price:$product->price;
            if(array_key_exists($product->id, $cart)){
                $cart[$product->id]['quantity'] +=1;
                $cart[$product->id]['total_price'] = $unit_price * $cart[$product->id]['quantity'];
            }else{
                $cart[$product->id] = 
                [
                    'title'         =>  $product->title,
                    'quantity'      =>  1,
                    'unit_price'    =>  $unit_price,
                    'total_price'   =>  $unit_price 
                ];
            }
        }else{
            $cart[$product->id] =
                [
                    'title'     =>  $product->title,
                    'quantity'  =>  1,
                    'unit_price'    =>  $unit_price,
                    'total_price'   =>  $unit_price 
                ];
        }

        session(['cart' => $cart]);
        session()->flash('message', $product->title." added to cart");
        return redirect()->route('cart.show');
    }


    public function removeFromCart(Request $request){
        try{
            $this->validate($request,[
                'product_id'    =>  'required'
            ]);
        }catch(ValidationException $e){
            return redirect()->back();
        }

        $cart = session()->has('cart')? session()->get('cart'): [];
        unset($cart[$request->product_id]);

        session(['cart' => $cart]);
        session()->flash('message','Item remove from cart successfully');

        return redirect()->back();

    }


    public function clearCart(){
        session(['cart'=> []]);
        session()->flash('message','Cart clear successfully');
        return redirect()->back();
    }
}
