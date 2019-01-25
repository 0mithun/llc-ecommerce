@extends('frontend.layouts.master')

@section('main')

<div class="container">
    <br>
    <div class="card">
        <div class="row">
            <aside class="col-md-5 border-right">
                <article class="gallery-wrap">
                    <div>
                        <img src="{{ $product->getFirstMediaUrl('products') }}" class="card-img-top" alt="{{ $product->title}}" />
                    </div>
                </article>
            </aside>
            <aside class="col-md-7">
                <article class="card-body p-5">
                    <h3 class="title mg-3">{{ $product->title }}</h3>
                    <p class="price-detail-wrap">
                        <span class="price h3 text-warning" >
                            @if ($product->sale_price != NULL)
                                <strike class="text-danger">BDT {{ number_format($product->price,2) }}</strike> &nbsp; &nbsp; BDT {{ number_format($product->sale_price,2) }}
                            @else
                                 BDT {{ number_format($product->price,2) }}
                            @endif
                        </span>
                    </p>
                    <dl class="item-property">
                        <dt>Description</dt>
                        <dd><p>{{ $product->description }}</p></dd>
                    </dl>
                    <hr>
                  
                        <form method="post" action="{{ route('cart.add') }}">
                            @csrf 
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                        </form>
                </article>
            </aside>
        </div>
    </div>
</div>


@stop