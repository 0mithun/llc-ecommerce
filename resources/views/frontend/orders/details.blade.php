@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <p class="text-center">Order Details</p>
        <hr>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message')}}
            </div>
        @endif
        <ul class="list-group">
            @foreach ($order->toArray() as $key => $value)
                @if(is_string($value) or is_float($value))
                <li class="list-group-item">{{ ucwords(str_replace('_',' ', $key)) }} : {{ $value }}</li>
                @endif
            @endforeach
            
        </ul>
        <hr>
        <h3>Order Products</h3>
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->product->title }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ number_format($product->price,2) }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2" class="text-right"><strong>Total</strong></td>
                        <td><strong>{{ number_format(array_sum(array_column($order->products->toArray(),'price')),2) }}</strong></td>
                    </tr>
            </tbody>
        </table>
 
        
        
    </div>

@stop