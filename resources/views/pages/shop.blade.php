@extends('layout')

@section('title', '商店')

@section('extra-css')

@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-container container">
            <div>
                <a href="/">首頁</a>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span>商品</span>
            </div>
            <div>
                @include('partials.menus.search')
            </div>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container">
        <div class="sidebar">
            <h3>所有分類</h3>
            <ul>
            @foreach ($categories as $category)
                <li class="{{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{ route('shop.index', ['category' => $category->slug])}}">{{ $category->name }}</a></li>
            @endforeach
            </ul>
        </div> <!-- end sidebar -->
        <div>
            <div class="products-header">
                <h1 class="stylish-heading">{{ $categorySlug }}</h1>
                <div>
                    <strong>價格: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">價格由低至高</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">價格由高至低</a>
                </div>
            </div>
            <div class="products text-center">

                @forelse ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->price }}</div>
                    </div>
                @empty
                    <div style="text-align: left"> 沒有任何商品 </div>
                @endforelse

            </div> <!-- end products -->

            <div class="spacer"></div>
                {!! $products->appends(request()->input())->links() !!}
        </div>
    </div><!-- end products-section -->
@endsection