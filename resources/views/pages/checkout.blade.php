@extends('layout')

@section('title', '結帳')

@section('content')

    <div class="container"><br>
        @include('partials.session-msg')

        <h1 class="checkout-heading stylish-heading">結帳</h1>
        <div class="checkout-section">
            <div class="checkout-table-container">
                <h2>您的商品</h2>

                <div class="checkout-table">
                    @foreach (Cart::instance(config('cart.cart_type'))->content() as $item)
                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="item" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item">{{ $item->model->name }}</div>
                                <div class="checkout-table-description">{{ $item->model->details }}</div>
                                <div class="checkout-table-price">{{ $item->subtotal }}</div>
                            </div>
                        </div>
                        <div class="checkout-table-row-right">
                            <div class="checkout-table-quantity">{{ $item->qty }}</div>
                        </div>
                    </div> <!-- end checkout-table-row -->
                    @endforeach
                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        商品總計 <br>
                        @if (session()->has('coupon'))
                        折扣碼({{ session()->get('coupon')['name'] }})
                            <form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" style="font-size:14px"> 移除 </button>
                            </form>
                            <br>
                        @endif
                        <span class="checkout-totals-total">結帳總金額</span>
                    </div>
                    @php
                        $subTotal = round(Cart::instance(config('cart.cart_type'))->subtotal());
                        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;
                        $total = round($subTotal - $discount);
                    @endphp
                    <div class="checkout-totals-right">
                        {{ $subTotal }} 元<br>
                        @if (session()->has('coupon'))
                            -{{ $discount }} 元<br>
                        @endif
                        <span class="checkout-totals-total">{{ $total }} 元</span>
                    </div>
                </div> <!-- end checkout-totals -->

                @if (!session()->has('coupon'))
                    <a href="#" class="have-code">是否有折扣碼?</a>
                    <div class="have-code-container">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="coupon_code">
                            <button type="submit" class="button button-plain">提交</button>
                        </form>
                    </div> <!-- end have-code-container -->
                @endif
                <br>
                <form action="{{ route('checkout.store') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="button button-plain">結帳</button>
                </form>
            </div>
        </div> <!-- end checkout-section -->
    </div>
@endsection