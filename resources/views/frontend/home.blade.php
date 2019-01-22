@extends('frontend.layouts.master')

@section('main')
    @include('frontend.partials._hero')

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->title}}">
                    <div class="card-body">
                        <p class="card-text">{{ $product->title }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <strong class="text-muted">BDT {{ $product->price }}</strong>
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