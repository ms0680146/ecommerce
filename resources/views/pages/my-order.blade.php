@extends('layout')

@section('title', '個人頁面')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-container container">
            <div>
                <a href="/">首頁</a>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span>個人頁面</span>
            </div>
            <div>
                @include('partials.menus.search')
            </div>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section my-orders container">
        <div class="sidebar">
            <ul>
              <li><a href="{{ route('users.profile.edit') }}">帳號設定</a></li>
              <li class="active"><a href="{{ route('users.order.index') }}">訂購清單</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">訂購清單</h1>
            </div>

            <div>
                @foreach ($orders as $order)
                <div class="order-container">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                <div class="uppercase font-bold">訂單時間</div>
                                <div>{{ \Carbon\Carbon::parse($order->created_at)->format('Y/m/d') }}</div>
                            </div>
                            <div>
                                <div class="uppercase font-bold">訂單編號</div>
                                <div>{{ $order->id }}</div>
                            </div><div>
                                <div class="uppercase font-bold">訂單總金額</div>
                                <div>{{ round($order->billing_total) }} 元</div>
                            </div>
                        </div>
                    </div>
                    <div class="order-products">
                        @foreach ($order->products as $product)
                            <div class="order-product-item">
                                <div><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="Product Image"></div>
                                <div>
                                    <div>
                                        <a href="{{ route('shop.show', $product->slug) }}">商品: {{ $product->name }}</a>
                                    </div>
                                    <div>金額: {{ round($product->price) }} 元</div>
                                    <div>數量: {{ $product->pivot->quantity }} 個</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div> <!-- end order-container -->
                @endforeach
            </div>

            <div class="spacer"></div>
        </div>
    </div>

@endsection