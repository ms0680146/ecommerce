<ul>
    <li><a href="{{ route('shop.index') }}">商品</a></li>
    <li>
        <a href="{{ route('cart.index') }}">購物車 
        @if (Cart::instance(config('cart.cart_type'))->count() > 0) 
            <span class="cart-count"><span>{{ Cart::instance(config('cart.cart_type'))->count() }}</span></span>
        @endif
        </a>
    </li>
</ul>