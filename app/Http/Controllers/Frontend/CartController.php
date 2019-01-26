<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $unit_price =  ($product->sale_price != NULl) ? $product->sale_price:$product->price;
        if(session()->has('cart')){
            $cart = session()->get('cart');
            
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

    public function checkout(){

        $data = [];
        $data['cart']= session()->has('cart')? session()->get('cart'): [];

        return view('frontend.checkout', $data);
    }

    public function procesedOrder(Request $request){
        $validator = Validator::make($request->all(),[
            'customer_name'             =>  'required',
            'phone_number'              =>  'required',
            'address'                   =>  'required',
            'city'                      =>  'required',
            'postal_code'               =>  'required'
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cart = session()->has('cart')? session()->get('cart'): [];
        $total = array_sum(array_column($cart, 'total_price'));

        $order = Order::create([
            'user_id'           =>  auth()->user()->id,
            'customer_name'     =>  $request->customer_name,
            'customer_phone_number'      =>  $request->phone_number,
            'address'           =>  $request->address,
            'city'              =>  $request->city,
            'postal_code'       =>  $request->postal_code,
            'total_amount'      =>  $total,
            'paid_amount'       =>  $total,
            'payment_details'   =>  'Cash on Delivery',


        ]);
      
        foreach ($cart as $product_id => $product) {
            $order->products()->create([
                'product_id'    =>  $product_id,
                'quantity'      =>  $product['quantity'],
                'price'         =>  $product['total_price']
            ]);
        }
        session(['cart'=> []]);
        session()->flash('type','success');
        session()->flash('message','Order Created Successfully');
        return redirect('/');
    }

}
