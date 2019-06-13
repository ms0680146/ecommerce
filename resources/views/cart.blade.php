@extends('layout')

@section('title', '購物車')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">首頁</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>購物車</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Cart::instance('cart')->count() > 0)
            <h2>{{ Cart::instance('cart')->count()}} 項商品被加入購物車</h2>

            <div class="cart-table">
                @foreach(Cart::instance('cart')->content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}"> {{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->detail }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options"> 移除 </button>
                            </form>
                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="cart-options"> 稍後購買 </button>
                            </form>
                        </div>
                        <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div>{{ $item->model->price}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach
            </div> <!-- end cart-table -->

            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="#">
                    <input type="text">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>
            </div> <!-- end have-code-container -->

            <div class="cart-totals">
                <div class="cart-totals-left"></div>

                <div class="cart-totals-right">
                    <div>
                        商品總計 <br>
                        稅(13%) <br>
                        <span class="cart-totals-total">結帳總金額</span>
                    </div>
                    <div class="cart-totals-subtotal">
                        {{ Cart::instance('cart')->subtotal() }} <br>
                        {{ Cart::instance('cart')->tax() }} <br>
                        <span class="cart-totals-total">{{ Cart::instance('cart')->total() }}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="#" class="button">Continue Shopping</a>
                <a href="#" class="button-primary">Proceed to Checkout</a>
            </div>

            @else
                <h3> 購物車中沒有任何商品! </h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button"> 繼續購物 </a>
                <div class="spacer"></div>
            @endif

            @if (Cart::instance('saveForLater')->count() > 0)
            <div class="saved-for-later cart-table">
                @foreach(Cart::instance('saveForLater')->content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name}}</a></div>
                            <div class="cart-table-description">{{ $item->model->detail }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="cart-options"> 移除 </button>
                            </form>
                            <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="cart-options"> 加進購物車 </button>
                            </form>
                        </div>
                        <div>{{ $item->model->price }}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach
            </div> <!-- end saved-for-later -->
            @else
                <h3> 沒有任何稍後購買的商品! </h3>
            @endif

        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection