<ul>
    @guest
    <li><a href="{{ route('register') }}">註冊</a></li>
    <li><a href="{{ route('login') }}">登入</a></li>
    @else
    <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            登出
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @endguest
    <li>
        <a href="{{ route('cart.index') }}">購物車 
        @if (Cart::instance(config('cart.cart_type'))->count() > 0) 
            <span class="cart-count"><span>{{ Cart::instance(config('cart.cart_type'))->count() }}</span></span>
        @endif
        </a>
    </li>
</ul>