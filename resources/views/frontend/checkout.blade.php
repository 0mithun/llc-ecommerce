@extends('frontend.layouts.master')

@section('main')

@guest()
<div class="container">
    <p class="text-center">Checkout</p>

    <div class="alert alert-warning">You need to <a href="{{ route('login') }}">Login</a> first to complete your order</div>
</div>


@else
<div class="container">
    <p class="text-center">Checkout</p>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill"> {{ count($cart) }}</span>
            </h4>
            <ul class="list-group mb-3">
               
               @foreach ($cart as $item)
                   
               
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $item['title'] }}</h6>
                        <small class="text-muted">Quantity {{ $item['quantity'] }}</small>
                    </div>
                    <span class="text-muted">{{ number_format($item['total_price'],2) }}</span>
                </li>
                @endforeach



                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total BDT</span>
                    <strong>{{ number_format(array_sum( array_column($cart, 'total_price')), 2) }}  </strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate method="post" action="{{ route('order') }}">
                @csrf 

                <div class="mb-3">
                    <label for="customer_name">Customer Name</label>
                    <div class="form-group">
                        <input type="text" value="{{ auth()->user()->name }}" class="form-control @if($errors->has('customer_name')) is-invalid  @endif" id="customer_name" name="customer_name" placeholder="Enter your name" required>
                        @if($errors->has('customer_name'))
                            <div class="invalid-feedback">
                                 {{ $errors->first('customer_name')}}
                            </div>
                         @endif 
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control @if($errors->has('phone_number')) is-invalid  @endif" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" />
                         @if($errors->has('phone_number'))
                            <div class="invalid-feedback">
                                 {{ $errors->first('phone_number')}}
                            </div>
                         @endif
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea class="form-control  @if($errors->has('address')) is-invalid   @endif" id="address" name="address"></textarea>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                 {{ $errors->first('address')}}
                            </div>
                         @endif
                </div>


                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="city">City</label>
                        <input class="form-control @if($errors->has('city')) is-invalid   @endif" type="text" name="city" id="city" value="" placeholder="City" />
                        @if($errors->has('city'))
                            <div class="invalid-feedback">
                                 {{ $errors->first('city')}}
                            </div>
                         @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control @if($errors->has('postal_code')) is-invalid   @endif" id="postal_code" name="postal_code"  placeholder="" required>
                        @if($errors->has('postal_code'))
                            <div class="invalid-feedback">
                                 {{ $errors->first('postal_code')}}
                            </div>
                         @endif
                    </div>
                </div>
             
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>


</div>
@endguest
@stop