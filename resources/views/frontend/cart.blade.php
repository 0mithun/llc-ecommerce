@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <p class="text-center">Cart</p>
        <hr>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message')}}
            </div>
        @endif

      
        @if(empty($cart))
            <div class="alert alert-danger">
                Empty Cart
            </div>
        @else

        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($cart as $key => $value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value['title'] }}</td>
                        <td>{{ number_format($value['unit_price'],2) }}</td>
                        <td><input type="number" name="quantity" value="{{ $value['quantity'] }}" /></td>
                        <td>{{ number_format($value['total_price'],2) }}</td>
                        <td>
                            <form method="post" action="{{ route('cart.remove') }}">
                                @csrf 
                                <input type="hidden" name="product_id" value="{{ $key }}" />
                                <button type="submit" class="btn btn-danger" >Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="4"  class="text-right"><strong>Total</strong></td>
                        <td colspan="2"><strong>BDT {{ number_format(array_sum( array_column($cart, 'total_price')), 2) }}</strong></td>        
                    </tr>
            </tbody>
        </table>
        <a class="btn btn-danger" href="{{ route('cart.clear') }}">Clear Cart</a>
        @endif

        
    </div>

@stop