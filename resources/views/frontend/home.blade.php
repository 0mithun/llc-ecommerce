@extends('frontend.layouts.master')

@section('main')
    @include('frontend.partials._hero')

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            @foreach($products as $product)

            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <a href="{{ route('product.details', $product->slug) }}">
                        <img class="card-img-top" src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->title}}">
                    </a>
                    <div class="card-body">
                        <p class="card-text"><a href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <form method="post" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                                </form>
                               
                            </div>
                            <strong class="text-muted">
                            @if ($product->sale_price != NULl)
                                <strike class="text-danger">BDT {{ number_format($product->price,2) }}</strike> &nbsp; &nbsp; BDT {{ number_format($product->sale_price,2) }}
                            @else
                                 BDT {{ number_format($product->price,2) }}
                            @endif
                           
                            
                            </strong>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            
        </div>
        {{ $products->render() }}
    </div>
</div>
@stop