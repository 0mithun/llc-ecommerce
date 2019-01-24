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
                            <span class="currency">BDT</span>
                            <span class="num">{{ number_format($product->price,2) }}</span>
                        </span>
                    </p>
                    <dl class="item-property">
                        <dt>Description</dt>
                        <dd><p>{{ $product->description }}</p></dd>
                    </dl>
                    <hr>
                    <a href="#" class="btn btn-lg btn-outline-primary text-uppercase">
                        <i class="fa fa-shopping-card">Add to cart</i>
                    </a>
                </article>
            </aside>
        </div>
    </div>
</div>


@stop