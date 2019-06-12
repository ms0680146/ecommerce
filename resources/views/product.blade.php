@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">首頁</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index') }}">商店</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>{{ $product->slug }}</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container">
        <div class="product-section-image">
            <img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product">
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->detail }}</div>
            <div class="product-section-price">{{ $product->price }}</div>
            <p>
                {{ $product->desctiption }}
            </p>

        </div>
    </div> <!-- end product-section -->
    
    @include('partials.might-like')


@endsection