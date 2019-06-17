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

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <ul>
                        {{ session()->get('error') }}
                    </ul>
                </div>
            @endif

            @if (Cart::instance(config('cart.cart_type'))->count() > 0)
            <h2>{{ Cart::instance(config('cart.cart_type'))->count()}} 項商品被加入購物車</h2>
            <div class="cart-table">
                @foreach(Cart::instance(config('cart.cart_type'))->content() as $item)
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
                            <select class="quantity" data-href="{{ route('cart.update', $item->rowId) }}" data-token="{{ csrf_token() }}">
                                @for($i=1; $i <= 5; $i++)
                                    <option {{ $item->qty == $i ? 'selected' : '' }} >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>{{ $item->subtotal}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach
            </div> <!-- end cart-table -->

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

            <div class="cart-totals">
                <div class="cart-totals-left"></div>
                <div class="cart-totals-right">
                    <div>
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
                        <span class="cart-totals-total">結帳總金額</span>
                    </div>
                    @php
                        $subTotal = Cart::instance(config('cart.cart_type'))->subtotal();
                        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;
                        $total = round($subTotal - $discount);
                    @endphp
                    <div class="cart-totals-subtotal">
                        {{ $subTotal }} 元<br>
                        @if (session()->has('coupon'))
                            -{{ $discount }} 元<br>
                        @endif
                        <span class="cart-totals-total">{{ $total }} 元</span>
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

            @if (Cart::instance(config('cart.saveForLater_type'))->count() > 0)
            <div class="saved-for-later cart-table">
                @foreach(Cart::instance(config('cart.saveForLater_type'))->content() as $item)
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

@section('extra-js')
    <script src="{{ asset('js/app.js')}}"> </script>
    <script>

        $('.quantity').each(function() {
            $(this).on('change', function () {
                console.log( $(this).val());
                console.log( $(this).data('href'));
                $.ajax({
                    url:  $(this).data('href'),
                    data: {
                        "quantity": $(this).val(),
                        "_token": $(this).data('token')
                    },
                    type: "PATCH",
                    success: function() {
                        window.location.href = '{{ route('cart.index') }}'
                    },
                    error: function (xhr) {
                        window.location.href = '{{ route('cart.index') }}'
                    }
                });
            });
        });
    </script>
@endsection